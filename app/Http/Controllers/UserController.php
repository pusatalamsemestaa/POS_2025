<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function user($id, string $name = null) {
        return view('user.user')->with(["id" => $id ,"name" => $name]);
    }
}