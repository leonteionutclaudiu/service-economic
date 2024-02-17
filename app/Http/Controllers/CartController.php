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
       $cartItems = Auth::user()->cart()->whereHas('product', function ($query) {
        $query->where('published', 1)->whereNull('deleted_at');
        })->get();

        return view('cart.cart', compact('cartItems'));
    }

    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
    ]);

    // Find the product
    $product = Product::findOrFail($request->product_id);

    // Check if the product is already in the user's cart
    $cartItem = Auth::user()->cart->where('product_id', $request->product_id)->first();

     // Check if the quantity exceeds the available stock
     if ($cartItem && $cartItem->quantity >= $product->stock_quantity) {
        return back()->with('error', 'Cantitate selectata prea mare. Stoc disponibil: ' . $product->stock_quantity);
    }


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

    // Find the cart item
    $cartItem = Auth::user()->cart->find($id);

    // Find the product associated with the cart item
    $product = $cartItem->product;

    // Check if the new quantity exceeds the available stock
    if ($request->quantity > $product->stock_quantity) {
        return redirect('/cart')->with('error', 'Cantitate selectata prea mare. Stoc disponibil: ' . $product->stock_quantity);
    }

    // Update quantity
    $cartItem->update(['quantity' => $request->quantity]);

    return redirect('/cart')->with('success', 'Coș actualizat cu succes');
}

    public function destroy($id)
    {
        $cartItem = Auth::user()->cart->find($id);
        $cartItem->delete();

        return redirect('/cart')->with('success', 'Produsul a fost șters din coș');
    }

    public function getCartItemCount()
    {
        $itemCount = Cart::whereHas('product', function ($query) {
            $query->where('published', 1)->whereNull('deleted_at');
        })->where('user_id', auth()->id())->count();

        return response()->json(['count' => $itemCount]);
    }
}
