<?php

namespace App\Http\Controllers;

use App\ContentModel;
use Illuminate\Http\Request;
use App\Http\Requests\ContentMoldelRequest;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.content-models.create', [
            'title' => 'Create new content model',
            'model' => new ContentModel
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentMoldelRequest $request)
    {
        try {
            ContentModel::create($request->all());
            response()->json([], 200);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContentModel  $contentModel
     * @return \Illuminate\Http\Response
     */
    public function edit(ContentModel $contentModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContentModel  $contentModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContentModel $contentModel)
    {
        //
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
}
