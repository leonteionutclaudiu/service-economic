<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Fetch the user's cart items
        $cartItems = Auth::user()->cart;

        return view('cart.cart', compact('cartItems'));
    }

    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
    ]);

    // Check if the product is already in the user's cart
    $cartItem = Auth::user()->cart->where('product_id', $request->product_id)->first();

    if ($cartItem) {
        // Update quantity if the product is already in the cart
        $cartItem->update(['quantity' => $cartItem->quantity + 1]);
    } else {
        // Create a new cart item and associate it with the user
        $newCartItem = new Cart([
            'product_id' => $request->product_id,
            'quantity' => 1,
        ]);

        Auth::user()->cart()->save($newCartItem);
    }

    return back()->with('success', 'Produsul a fost adăugat în coș');
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Update quantity of a product in the user's cart
        $cartItem = Auth::user()->cart->find($id);
        $cartItem->update(['quantity' => $request->quantity]);

        return redirect('/cart')->with('success', 'Coș actualizat cu succes');
    }

    public function destroy($id)
    {
        // Remove a product from the user's cart
        $cartItem = Auth::user()->cart->find($id);
        $cartItem->delete();

        // You can return a response or redirect back to the cart page
        return redirect('/cart')->with('success', 'Produsul a fost șters din coș');
    }
}
