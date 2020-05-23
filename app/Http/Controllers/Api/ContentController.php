<?php

namespace App\Http\Controllers\Api;

use App\Content;
use App\MetaContent;
use App\Http\Requests\ContentRequest;
use App\Http\Controllers\Controller;
use App\MetaField;
use \DB;

class ContentController extends Controller
{
    public function index()
    {
        $modelId = request()->get('model_id');
        $search = request()->get('search');
        $column = request()->get('column');
        $sort = request()->get('sort');

        $model = MetaContent::find($modelId);

        if(empty($model)) {
            return response()->json([], 200);
        }

        $items = $model
            ->contents()
            ->where('title', 'like', "{$search}%")
            ->orderBy($column, $sort)->paginate(15);

        return response()->json($items->appends(request()->except('page')), 200);
    }

    public function store(ContentRequest $request)
    {
        DB::beginTransaction();

        $params = $request->only('title', 'published', 'meta_content_id');
        $params['published'] = (integer) ($request->input('published') == "true");

        $model = Content::create($params);

        $fields = $request->input("fields", []);

        foreach ($fields as $slug => $field) {
            $field = $model->fields()->create([
                'value' => $field
            ]);

            $metaField = MetaField::where('slug', $slug)->where('meta_content_id', $params['meta_content_id'])->first();
            $metaField->fields()->save($field);
        }

        $requestFiles = $request->allFiles();
        $files = $requestFiles['files'] ?? [];

        foreach ($files as  $collectionName => $collection) {
            foreach ($collection as  $item) {
                $model->addMedia($item)->toMediaCollection($collectionName);
            }
        }

        DB::commit();

        return response()->json(['id' => $model->id]);
    }

    public function show(Content $content)
    {
        $fields = [];

        foreach ($content->fields()->get() as $field) {
              $fields[$field->meta->slug] = $field->value;
        }

        $content->fields = $fields;

        $mediaFields = MetaField::where("meta_content_id", $content->meta_content_id)->where("type", "media")->get();

        $uploadedFiles = [];

        foreach ($mediaFields as $field) {
            $media = $content->getMedia($field->slug);

            foreach ($media as $item) {
                $uploadedFiles[$field->slug][] = [
                    'id' => $item->id,
                    'thumb' => $item->getUrl('thumb'),
                    'name' => $item->file_name,
                    'size' => $item->size,
                    'type' => $item->mime_type
                ];
            }
        }

        $content->uploadedFiles = $uploadedFiles;

        return response()->json($content);
    }

    public function update(ContentRequest $request, Content $content)
    {
        DB::beginTransaction();

        $params = $request->only('title', 'published', 'meta_content_id');
        $params['published'] = (integer) ($request->input('published') == "true");

        $content->update($params);

        $fields = $request->input("fields", []);

        foreach ($fields as $slug => $value) {

            $field = MetaField::where('slug', $slug)
                ->where('meta_content_id', $params['meta_content_id'])->first()
                ->fields()->where('content_id', $content->id)->first();

            if($field) {
                $field->update([
                    'value' => $value
                ]);
            } else {
                $field = $content->fields()->create([
                    'value' => $value
                ]);

                $metaField = MetaField::where('slug', $slug)->where('meta_content_id', $params['meta_content_id'])->first();
                $metaField->fields()->save($field);
            }

        }

        $requestFiles = $request->allFiles();
        $files = $requestFiles['files'] ?? [];
        $deletedFilesIds = $request->input('deleted_filesids') ? $request->input('deleted_filesids') : [];
        $mediaFields = MetaField::where("meta_content_id", $content->meta_content_id)->where("type", "media")->get();

        foreach ($mediaFields as $field) {
            $collectionName = $field->slug;

            $exceptForDeleteMedia = $content->getMedia($collectionName)->filter(function ($item) use ($deletedFilesIds) {
                return !in_array($item->id, $deletedFilesIds);
            })->all();

            $content->clearMediaCollectionExcept($collectionName, $exceptForDeleteMedia);
        }

        //save new media
        foreach ($files as  $collectionName => $collection) {
            foreach ($collection as  $item) {
                $content->addMedia($item)->toMediaCollection($collectionName);
            }
        }

        DB::commit();
    }

    public function destroy(Content $content)
    {
        $content->delete();
    }
}
