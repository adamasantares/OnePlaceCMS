<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\MediaTemporaryStorage;
use App\Helpers\CmsHelper;

class MediaController extends Controller
{
    public function store(Request $request)
    {
        CmsHelper::validationFiles($request);

        $path = request()->file('file')->storeAs("/media-temp/".date("Y-m-d"), request()->file('file')->getClientOriginalName());

        $media = MediaTemporaryStorage::create([
            'name' => basename($path),
            'size' => Storage::size($path),
            'path' => $path
        ]);

        return response()->json([
            'id' => $media->id,
            'name' => $media->name,
            'size' => $media->size
        ], 200);
    }
}
