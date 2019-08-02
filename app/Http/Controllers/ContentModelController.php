<?php

namespace App\Http\Controllers;

use App\ContentModel;
use App\ContentField;
use App\Http\Requests\ContentModelRequest;

class ContentModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = ContentModel::where('title', 'like', request()->get('search').'%')->orderBy(request()->get('column'), request()->get('sort'))->paginate(15);

        return response()->json($models->appends(request()->except('page')), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentModelRequest $request)
    {
        try {
            $inputFields = $request->input('contentFields');

            $fields['fields'] = [];
            foreach ($inputFields as $index => $value) {
                $fields['fields'][] = [
                    '_id' => $value['_id'],
                    'api_id' => $value['api_id'],
                    'name' => $value['name'],
                    'type' => $value['type'],
                    'validations' => $value['validations'],
                    'order' => $index,
                ];
            }

            $attributes = $request->only('title', 'api_id', 'desc', 'published');
            $attributes = array_merge($attributes, $fields);
            $model = ContentModel::create($attributes);

            return response()->json(['_id' => $model->id], 200);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContentModel  $contentModel
     * @return \Illuminate\Http\Response
     */
    public function show(ContentModel $contentModel)
    {
        if (empty($contentModel)) {
            return response()->json([], 404);
        }

        return response()->json(['model' => $contentModel, 'fields' => $contentModel->fields], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContentModel  $contentModel
     * @return \Illuminate\Http\Response
     */
    public function update(ContentModelRequest $request, ContentModel $contentModel)
    {
        try {
            $inputFields = $request->input('contentFields');

            $fields['fields'] = [];
            foreach ($inputFields as $index => $value) {
                $fields['fields'][] = [
                    '_id' => $value['_id'],
                    'api_id' => $value['api_id'],
                    'name' => $value['name'],
                    'type' => $value['type'],
                    'validations' => $value['validations'],
                    'order' => $index,
                ];
            }

            $attributes = $request->only('title', 'api_id', 'desc', 'published');
            $attributes = array_merge($attributes, $fields);
            $contentModel->update($attributes);

            return response()->json(['_id' => $contentModel->id], 200);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContentModel  $contentModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContentModel $contentModel)
    {
        $contentModel->delete();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $models = ContentModel::where('published', true)->orderBy('title', 'asc')->get();

        return response()->json($models, 200);
    }
}
