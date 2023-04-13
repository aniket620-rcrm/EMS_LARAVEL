<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        // if($id){
        //     $user = User::find($id);
        // }else{
        //     $user = User::all();
        // }
        // return $user;
        $user = auth()->user();
         return $user;
    }
}
