<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class getImage extends Controller
{
    public function index(int $userId)
    {
        $user = User::findOrFail($userId);

        $images = $user->images->map(function ($image) {
            return [
                'image_path' => asset('storage/' . $image->image_path)
            ];
        });

        return response()->json(['images' => $images]);
    }

}
