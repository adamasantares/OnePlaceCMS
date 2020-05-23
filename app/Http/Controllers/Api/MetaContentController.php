<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\MetaContentRequest;
use App\MetaContent;
use App\Http\Controllers\Controller;
use \DB;

//todo move db logic to dao
class MetaContentController extends Controller
{
    public function index()
    {
        $search = request()->get('search') . '%';
        $column = request()->get('column', 'title');
        $sort = request()->get('sort', 'asc');
        $models = MetaContent::where('title', 'like', $search)->orderBy($column, $sort)->paginate(15);

        return response()->json($models->appends(request()->except('page')));
    }

    public function all() {
        $items = MetaContent::where('published', true)->orderBy('title', 'asc')->get();

        return response()->json($items);
    }

    public function store(MetaContentRequest $request)
    {
        DB::beginTransaction();

        $metaContent = new MetaContent();
        $metaContent = $metaContent->create($request->all(['title', 'slug', 'desc', 'published']));

        $inputFields = $request->input('contentFields');

        foreach ($inputFields as $index => $value) {
            $metaField = $metaContent->fields()->create([
                'slug' => $value['slug'],
                'title' => $value['title'],
                'type' => $value['type'],
                'order' => ++$index
            ]);


            //todo fix
//            foreach($value['validations'] as $name => $value) {
//                $metaField->validations()->create([
//                    'name' => $name,
//                    'value' => $value
//                ]);
//            }

        }

        DB::commit();

        return ['id' => $metaContent->id];
    }

    public function show(MetaContent $metaContent)
    {
        $metaContent->load(["fields", "fields.validations"]);

        return $metaContent;
    }

    public function update(MetaContentRequest $request, MetaContent $metaContent)
    {
        DB::beginTransaction();

        $metaContent->update($request->all(['title', 'desc', 'published']));

        $inputFields = $request->input('contentFields');

        $fieldSlugs = array_pluck($inputFields, 'slug');

        $metaContent->fields()->whereNotIn('slug', $fieldSlugs)->delete();

        foreach ($inputFields as $index => $value) {
            $metaField = $metaContent->fields()->updateOrCreate([
                'slug' => $value['slug'],
            ],
            [
                'title' => $value['title'],
                'type' => $value['type'],
                'order' => ++$index
            ]);


            //todo fix
//            foreach($value['validations'] as $name => $value) {
//                $metaField->validations()->updateOrCreate([
//                    'name' => $name,
//                    'value' => $value
//                ]);
//            }
        }

        DB::commit();
    }

    public function destroy(MetaContent $metaContent)
    {
        $metaContent->delete();
    }
}
