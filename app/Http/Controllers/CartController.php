<?php

namespace App\Http\Controllers;

use App\Orders;
use Cart;
use Illuminate\Http\Request;
use Melihovv\ShoppingCart\Facades\ShoppingCart;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function showtocart(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
            'id' => 'required'
        ]);

        Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->amount,
            'quantity' => 1,
            'vendor_id' => $request->vendor_id,
        ));

        return back()->with('added', 'Item added to Cart');
    }


    public function showCart()
    {
        $items = Cart::getContent();

        return view('cart', ['items' => $items]);
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $request->session()->put('name', $request->name);
        $request->session()->put('amount', floatval($request->prize));
        $request->session()->put('product_id', intval($request->id));
        $request->session()->put('quantity', intval($request->quantity));

        return view('checkout');
    }

    public function checkout()
    {
        $items = Cart::getContent();

        return view('checkout', ['items' => $items]);
    }

    public function showOrderDetails($id)
    {
        $order = Orders::where('id', $id)->first();

        return view('order-details', ['order' => $order]);
    }

    public function deleteOrder(Request $request)
    {
        $order = Orders::where('id', $request->id)->first();
        $order->delete();

        return back()->with('deleted', 'Order removed successfully!');
    }
}
