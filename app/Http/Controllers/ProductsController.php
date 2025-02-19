<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function foodbeverage()
    {
        return view('kategori.foodbeverage');
    }
    public function beautyhealth()
    {
        return view('kategori.beautyhealth');
    }
    public function homercare()
    {
        return view('kategori.homercare');
    }
    public function babykid()
    {
        return view('kategori.babykid');
    }
}
