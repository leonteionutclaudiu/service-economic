<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $shippingAddress = $user->shippingAddress;
        $billingAddress = $user->billingAddress;

        // Verificăm dacă toate campurile din adresa de livrare sunt completate
        $shippingAddressCompleted = $this->checkAddressCompleteness($shippingAddress);

        // Verificăm dacă toate campurile din adresa de facturare sunt completate
        $billingAddressCompleted = $this->checkAddressCompleteness($billingAddress);

        // Verificăm dacă toate campurile adreselor sunt completate
        $addressesCompleted = $shippingAddressCompleted && $billingAddressCompleted;

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

        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
            $price = $product->sale_price ?? $product->price;
            $totalPrice += $price * $cartItem->quantity;
        }

        // Check if the cart is empty
        if ($cartItems->isEmpty()) {
            return redirect('/')->with('error', 'Nu ai produse în coș.');
        }

        return view('checkout', compact('cartItems', 'user', 'shippingAddress', 'billingAddress', 'totalPrice', 'addressesCompleted'));
    }

     // Metoda pentru a verifica completarea adresei
     private function checkAddressCompleteness($address)
     {
         return $address &&
                !empty($address->address_line) &&
                !empty($address->city) &&
                !empty($address->state) &&
                !empty($address->postal_code);
     }
}
