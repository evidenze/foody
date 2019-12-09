<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Vendor;
use App\Products;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('assign.guard:admin,admin/login');
    }

    public function index()
    {
        $vendors = Vendor::all();
        $products = Products::all();
        $pending = Orders::where('delivered', false)->get();
        $delivered = Orders::where('delivered', true)->get();
        $earning = Orders::all()->sum('prize');

        return view('admin', [
            'vendors' => $vendors, 
            'pending' => $pending, 
            'earning' => $earning, 
            'delivered' => $delivered,
            'products' => $products,
            ]);
    }

    public function showOrderDetails(Request $request, $id)
    {
        $products = Products::where('id', $id)->first();

        return view('product-details', ['product' => $products]);
    }

    public function confirmProduct(Request $request)
    {
        $product = Products::where('id', $request->id)->first();
        $product->is_verified = true;
        $product->save();

        return back()->with('verified', 'Product has been verified successfully.');
    }
}
