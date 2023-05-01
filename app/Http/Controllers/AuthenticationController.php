<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{

    public function register(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'user_role_id' => 'required',
            'city' => 'required',
            'Bio' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors(),
            ], 422);
        }

        $allData = $request->all();
        $allData['password'] = bcrypt('password');
        $allData['user_status_id'] = 2;
        $allData['joining_date'] = now();
        $allData['image_path'] = "https://";

        $user = User::create($allData);

        $resArr = [];
        $resArr['token'] = $user->createToken('api-application')->accessToken;
        $resArr['name'] = $user->name;
        return response()->json($resArr, 200);
    }

    public function login(Request $request)
    {

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $email = $request->email;
            $user = User::where('email', '=', $email)->first();
            $user_status_id = $user['user_status_id'];
            $userStatus = UserStatus::where('id', '=', $user_status_id)->first();
            if ($userStatus['status'] === 0) {
                return response()->json([
                    'errors' => ['1' => "User is Inactive"],
                ], 422);
            }
            $user = Auth::user();
            $resArr = [];
            $resArr['token'] = $user->createToken('api-application')->accessToken;
            $resArr['name'] = $user->name;
            return response()->json($resArr, 200);
        } else {
            return response()->json(['error' => 'UnAuthorized Access'], );
        }
    }
}
