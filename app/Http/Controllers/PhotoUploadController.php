<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoUploadController extends Controller
{
    public function upload(Request $request)
    {
        $files = $request->file('files');

        $albumId = time();

        foreach ($files as $file) {

            $path = Storage::putFile('public/photos', $file);

            $photo = new Photo();
            $photo->user_id = 1;
            $photo->path = $path;
            $photo->album_id = $albumId;
            $photo->save();
        }

        $uploadedPhotos = Photo::where('album_id', $albumId)->get();

        return view('portfolio')->with('photos', $uploadedPhotos);
    }

    public function process(Request $request)
    {
        $albumId = $request->input('album_id');

        $uploadedPhotos = Photo::where('album_id', $albumId)->get();

    }

}
