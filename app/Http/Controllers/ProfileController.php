<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $shippingAddress = $user->shippingAddress;
        $billingAddress = $user->billingAddress;

        return view('profile.edit', compact('user', 'shippingAddress', 'billingAddress'));
    }

    /**
     * Update the user's profile information.
     */
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

        return Redirect::route('profile.edit')->with('status', 'Profil actualizat.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        session()->flash('success', 'Cont șters cu succes! Ne pare rău ca ne-ai părăsit :( .');

        return Redirect::to('/');
    }

    public function getOrders() {
        return view('profile.orders');
    }
}
