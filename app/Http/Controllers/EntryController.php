<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;
use App\MediaTemporaryStorage;
use App\ContentField;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Entry::where('model_id', '=', request()->get('model_id'))
                        ->where('title', 'like', request()->get('search').'%')
                        ->orderBy(request()->get('column'), request()->get('sort'))->paginate(15);

        return response()->json($models->appends(request()->except('page')), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $model = Entry::create($request->only('title', 'published', 'model_id', 'fields'));
            $files = $request->input('files');

            foreach ($files as  $collectionName => $collection) {
                foreach ($collection as  $item) {

                    if(isset($item['response']['id'])) {
                        $media = MediaTemporaryStorage::find($item['response']['id']);

                        $model->addMedia(storage_path("app/" . $media->path))
                            ->toMediaCollection($collectionName);
                    }
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
    public function show(Entry $contentEntry)
    {
        if (empty($contentEntry)) {
            return response()->json([], 404);
        }

        $contentEntry->files = [];

        $mediaFields = ContentField::where('model_id', $contentEntry->model_id)->where('type', 'media')->get()->pluck('api_id');

        foreach ($mediaFields as $field) {
            $media = $contentEntry->getMedia($field);
            $mediaFormatted = [];

            foreach ($media as $item) {
                $mediaFormatted[] = [
                    'id' => $item->id,
                    'thumb' => $item->getUrl('thumb'),
                    'name' => $item->file_name,
                    'size' => $item->size,
                    'type' => $item->mime_type
                ];
            }

            $contentEntry->files = array_merge($contentEntry->files, [$field => $mediaFormatted]);
        }

        return response()->json($contentEntry, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $contentEntry)
    {
        try {
            $contentEntry->update($request->only('title', 'published', 'fields'));

            $files = $request->input('files');

            foreach ($files as  $collectionName => $collection) {
                foreach ($collection as  $item) {

                    if(isset($item['response']['id'])) {
                        $media = MediaTemporaryStorage::find($item['response']['id']);

                        //TODO refactor upload method
                        if(!empty($media)) {
                            $contentEntry->addMedia(storage_path("app/" . $media->path))
                                ->toMediaCollection($collectionName);

                            $media->delete();
                        }

                    }
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
    public function destroy(Entry $contentEntry) {
        $contentEntry->delete();
    }
}
