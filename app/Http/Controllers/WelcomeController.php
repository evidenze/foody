<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\Products;

class WelcomeController extends Controller
{
    public function index()
    {
        $vendors = Vendor::where('is_active', true)->get();

        return view('welcome', ['vendors' => $vendors]);
    }

    public function showShop($id)
    {
        $products = Products::where([['vendor_id', '=', $id], ['is_verified', '=', true]])->get();
        $vendor = Vendor::where('id', $id)->first();

        return view('shop', ['products' => $products, 'vendor' => $vendor]);
    }
}
