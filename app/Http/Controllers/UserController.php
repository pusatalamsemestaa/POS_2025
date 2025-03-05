<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //public function user($id, string $name = null) {
    //return view('user1')->with(["id" => $id ,"name" => $name]);
    //}

    public function index()
    {
        $userCount = UserModel::where('level_id', 2)->count();

        return view('user', ['userCount' => $userCount]);
    }
}
