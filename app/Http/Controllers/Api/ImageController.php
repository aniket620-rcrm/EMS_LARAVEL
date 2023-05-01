<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
{

    $imagePath = null;
    $id = $request->id;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('public');
    }

    $image = $request->file('image');
    if (!$image->isValid()) {
        return response()->json(['error' => 'Invalid image file']);
    }

    $post = User::find($id);
    $post->image_path = $imagePath;
    $post->save();

    return response()->json(['message' => 'Post created successfully']);
}

}
