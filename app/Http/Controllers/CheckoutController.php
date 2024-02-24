<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $shippingAddress = $user->shippingAddress;
        $billingAddress = $user->billingAddress;

        $totalPrice = 0;

        // Fetch the user's cart items
        $cartItems = Auth::user()->cart()->whereHas('product', function ($query) {
            $query->where('published', 1)->whereNull('deleted_at');
        })->get();

        // Remove any cart items where the associated product has stock_quantity = 0
        foreach ($cartItems as $cartItem) {
            if ($cartItem->product->stock_quantity == 0) {
                $cartItem->delete();
            }
        }

        // Fetch the user's cart items after delete
        $cartItems = Auth::user()->cart()->whereHas('product', function ($query) {
            $query->where('published', 1)
                ->whereNull('deleted_at');
        })->get();

        // Calculate total price
        foreach ($cartItems as $cartItem) {
            $totalPrice += $cartItem->product->price * $cartItem->quantity;
        }

        // Check if the cart is empty
        if ($cartItems->isEmpty()) {
            return redirect('/')->with('error', 'Nu ai produse în coș.');
        }

        return view('checkout', compact('cartItems', 'user', 'shippingAddress', 'billingAddress', 'totalPrice'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user->save();

        // update or save shipping address
        $user->shippingAddress()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'address_line' => $request->shipping_address_line,
                'city' => $request->shipping_city,
                'state' => $request->shipping_state,
                'postal_code' => $request->shipping_postal_code,
            ]
        );

        // update or save billing address
        $user->billingAddress()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'address_line' => $request->billing_address_line,
                'city' => $request->billing_city,
                'state' => $request->billing_state,
                'postal_code' => $request->billing_postal_code,
            ]
        );
    }
}
