<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\ContentModel;
use Illuminate\Http\Request;

class ContentModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = ContentModel::where('title', 'like', '%'.request()->get('query-content-model').'%')->orderBy('created_at', 'desc')->paginate(15);

        return view('manage.content-models.index', [
            'models' => $models->appends(request()->except('page')),
            'title' => 'Content Models'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
