<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoUploadController extends Controller
{
    public function upload(Request $request)
    {
        $folderPath = $request->file('folder')->getRealPath();
        $files = glob($folderPath . '/*');

        $albumId = time(); 

        foreach ($files as $file) {
            $path = Storage::putFile('public/photos', $file);

            $photo = new Photo();
            $photo->user_id = 1;
            $photo->path = $path;
            $photo->album_id = $albumId;
            $photo->save();
        }
dd('hello');
        return redirect()->back()->with('success', 'Folder uploaded successfully!');
    }

    public function Portfolio()
    {
        $latestAlbum = Photo::orderBy('album_id', 'desc')->first();
        $photos = Photo::where('album_id', $latestAlbum->album_id)->get();

        return view('portfolio.index', compact('photos'));
    }
}
