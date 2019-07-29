<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;
use App\ContentField;
use App\Helpers\CmsHelper;

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
        $request->validate([
            'title' => 'required',
            'model_id' => 'required',
            'published' => 'required'
        ]);

        CmsHelper::validationFields($request);

        try {
            $model = Entry::create($request->only('title', 'published', 'model_id', 'fields'));
//            $files = $request->input('files', []);
//
//            foreach ($files as  $collectionName => $collection) {
//                foreach ($collection as  $item) {
//
//                    if(isset($item['response']['id'])) {
//                        $media = MediaTemporaryStorage::find($item['response']['id']);
//
//                        $model->addMedia(storage_path("app/" . $media->path))
//                            ->toMediaCollection($collectionName);
//
//                        $media->delete();
//                    }
//                }
//            }

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

        $entry->files = [];

        $mediaFields = ContentField::where('model_id', $entry->model_id)->where('type', 'media')->get()->pluck('api_id');

        foreach ($mediaFields as $field) {
            $media = $entry->getMedia($field);
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

            $entry->files = array_merge($entry->files, [$field => $mediaFormatted]);
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
    public function update(Request $request, Entry $entry)
    {

        $request->validate([
            'title' => 'required',
            'model_id' => 'required',
            'published' => 'required'
        ]);

        CmsHelper::validationFields($request);

        try {
            $entry->update($request->only('title', 'published', 'fields'));

//            $files = $request->input('files', []);
//
//            foreach ($files as  $collectionName => $collection) {
//                //find medias by ids from request
//                $exceptForDeleteMedia = $entry->getMedia($collectionName)->filter(function ($item) use ($collection) {
//                    return in_array($item->id, array_column($collection, 'id'));
//                })->all();
//
//                //delete not found medias
//                $entry->clearMediaCollectionExcept($collectionName, $exceptForDeleteMedia);
//
//                //save new media
//                foreach ($collection as $item) {
//                    if(isset($item['response']['id'])) {
//                        $media = MediaTemporaryStorage::find($item['response']['id']);
//
//                        if(!empty($media)) {
//                            $entry->addMedia(storage_path("app/" . $media->path))
//                                ->toMediaCollection($collectionName);
//
//                            $media->delete();
//                        }
//                    }
//                }
//            }

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

    public function getByModel($model_id)
    {
        $entries = Entry::where('model_id', $model_id)->where('published', true)->get();

        return response()->json($entries, 200);
    }
}
