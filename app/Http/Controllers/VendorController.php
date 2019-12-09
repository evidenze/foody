<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use App\Vendor;
use App\Products;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    public function index()
    {
        $products = Products::where('vendor_id', Auth::user()->id)->get();
        $pending = Orders::where('delivered', false)->get();
        $delivered = Orders::where('delivered', true)->get();
        $earning = Orders::all()->sum('prize');

        return view('vendor.home', ['products' => $products, 'pending' => $pending, 'earning' => $earning, 'delivered' => $delivered]);
    }

    public function addProduct()
    {
        return view('vendor.add-product');
    }

    public function saveProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photo' => 'required',
            'quantity' => 'required',
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        $response = new Products;
        $response->name = $request->name;
        $response->quantity = $request->quantity;
        $response->photo = $request->photo->store('photos');
        $response->amount = $request->amount;
        $response->description = $request->description;
        $response->vendor_id = Auth::user()->id;
        $response->save();

        return redirect()->route('vendor.home')->with('added', 'Product added successfully.');

    }

    public function editProduct($id)
    {
        $product = Products::where('id', $id)->first();

        return view('vendor.edit-product', ['product' => $product]);
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
        ]);

        $product = Products::where('id', $id)->first();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->amount = $request->amount;
        $product->save();

        return redirect()->route('vendor.home')->with('edited', 'Product updated successfully.');
    }
}
