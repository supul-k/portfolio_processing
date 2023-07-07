<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'photos' => 'required|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        foreach ($request->file('photos') as $file) {
            $path = $file->store('public/photos');

            $photo = new Photo();
            $photo->path = $path;
            $photo->save();
        }

        return redirect()->back()->with('success', 'Photos uploaded successfully!');
    }
}
