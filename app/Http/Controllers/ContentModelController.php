<?php

namespace App\Http\Controllers;

use App\ContentModel;
use App\ContentField;
use Illuminate\Http\Request;
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
            $model = ContentModel::create($request->only('title', 'api_id', 'desc', 'published'));
            $fields = $request->input('contentFields');

            foreach ($fields as $index => $value) {
               ContentField::create(
                    [
                        'api_id' => $value['api_id'],
                        'name' => $value['name'],
                        'validations' => $value['validations'],
                        'order' => $index,
                        'model_id' => $model->id
                    ]
                );
            }

            return response()->json(['_id' => $model->id], 200);
        } catch (\Exception $e) {
            response()->json([], 500);
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

        return response()->json(['model' => $contentModel, 'fields' => $contentModel->fields()->get()], 200);
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
        $contentModel->update($request->only('title', 'desc', 'published'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContentModel  $contentModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContentModel $contentModel)
    {
        $contentModel->fields()->delete();
        $contentModel->delete();
    }
}
