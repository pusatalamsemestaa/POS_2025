<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class SalesController extends Controller
{
    public function transaction() {
        return view('sales.transaction');
    }
}