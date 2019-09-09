<?php

namespace App\Http\Controllers;

use App\Entry;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Http\Requests\EntryRequest;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelId = request()->get('model_id');
        $search = request()->get('search');
        $column = request()->get('column');
        $sort = request()->get('sort');

        $models = Entry::where('model_id', '=', $modelId)
                        ->where('title', 'like', "{$search}%")
                        ->orderBy($column, $sort)->paginate(15);

        return response()->json($models->appends(request()->except('page')), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntryRequest $request)
    {
        try {
            $model = Entry::create($request->only('title', 'published', 'model_id', 'fields'));
            $requestFiles = $request->allFiles();
            $files = $requestFiles['files'] ?? [];

            foreach ($files as  $collectionName => $collection) {
                foreach ($collection as  $item) {
                    $model->addMedia($item)->toMediaCollection($collectionName);
                }
            }
            return response()->json(['_id' => $model->id], 200);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        if (empty($entry)) {
            return response()->json([], 404);
        }

        $fields = $entry->model->fields;

        foreach ($fields as $field) {
            if($field['type'] != 'media') continue;

            $uploadedFiles = [];
            $media = $entry->getMedia($field['api_id']);

            foreach ($media as $item) {
                $uploadedFiles[$field['api_id']][] = [
                    'id' => $item->id,
                    'thumb' => $item->getUrl('thumb'),
                    'name' => $item->file_name,
                    'size' => $item->size,
                    'type' => $item->mime_type
                ];
            }
            $entry->uploadedFiles = $uploadedFiles;
        }

        return response()->json($entry, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(EntryRequest $request, Entry $entry)
    {
        try {
            $entry->update($request->only('title', 'published', 'fields'));
            $requestFiles = $request->allFiles();
            $files = $requestFiles['files'] ?? [];
            $deletedFilesIds = $request->input('deleted_files_ids') ? $request->input('deleted_files_ids') : [];

            $fields = $entry->model->fields;
            $mediaFields = array_filter($fields, function ($field) {
                return $field['type'] == 'media';
            });

            foreach ($mediaFields as $field) {
                $collectionName = $field['api_id'];

                $exceptForDeleteMedia = $entry->getMedia($collectionName)->filter(function ($item) use ($deletedFilesIds) {
                    return !in_array($item->id, $deletedFilesIds);
                })->all();

                $entry->clearMediaCollectionExcept($collectionName, $exceptForDeleteMedia);
            }

            //save new media
            foreach ($files as  $collectionName => $collection) {
                foreach ($collection as  $item) {
                    $entry->addMedia($item)->toMediaCollection($collectionName);
                }
            }

            return response()->json([], 200);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        $entry->delete();
    }

    /**
     * Get entries by ContentModel id
     *
     * @param $model_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByModel($model_id)
    {
        $entries = Entry::where('model_id', $model_id)->where('published', true)->get();

        return response()->json($entries, 200);
    }
}
