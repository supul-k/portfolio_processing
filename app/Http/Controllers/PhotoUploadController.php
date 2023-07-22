<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
            $photo->caption = $file->getClientOriginalName();
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

        // Move uploaded photos to the ML project's images folder
        foreach ($uploadedPhotos as $photo) {
            $path = $photo->getAttribute('path');
            $filename = str_replace('public/photos/', '', $path);
            $filePath = 'photos/' . $filename;
            $destinationFilePath = '/ML_Project/images/' . $filename;
            // $fileContents = Storage::disk('public')->get($filePath);
            Storage::disk('local')->copy($path, $destinationFilePath);

            // if (Storage::disk('local')->exists($destinationFilePath)) {
            //     // Photo copied successfully, you can proceed with further actions or logging.
            //     // For example, you could update the $photo model with information about the successful copy.
            //     dd('copied successfully');
            // } else {
            //     // Photo was not copied successfully, handle the error or log it.
            // }
            // $fileName = pathinfo($path, PATHINFO_BASENAME);
            // $temporaryPath = '/path/to/ML_Project/images/' . $fileName;

            // Move the image to the ML project's images folder

            // Now, you can execute the Python script or command with the temporary image file as an argument
            $command = "python ML_Project/new.py";
            $output = shell_exec($command);
            dd( $output);

            // Process the output from the Python script or command
            // ...

            // Update the Photo model with the processed data
            // ...
        }
    }
}
