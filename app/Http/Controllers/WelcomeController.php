<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\Products;

class WelcomeController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all();

        return view('welcome', ['vendors' => $vendors]);
    }

    public function showShop($id)
    {
        $products = Products::where('vendor_id', $id)->get();

        return view('shop', ['products' => $products]);
    }
}
