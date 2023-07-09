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
        dd($uploadedPhotos);
        // Save uploaded photos to a temporary directory
        foreach ($uploadedPhotos as $photo) {
            $path = $photo->getAttribute('path');
            $file = Storage::disk('local')->path($path);
            $temporaryPath = '/path/to/temporary/directory/' . $photo->id . '.jpg';
            copy($file, $temporaryPath);
            $photo->temporaryPath = $temporaryPath;

            // Execute the Python script or command with the temporary image file as argument
            $command = "python /path/to/your/python_script.py " . escapeshellarg($temporaryPath);
            $output = shell_exec($command);

            // Process the output from the Python script or command
            // ...

            // Update the Photo model with the processed data
            // ...
        }
    }
}
