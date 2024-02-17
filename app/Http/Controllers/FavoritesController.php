<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function index()
    {
        // Fetch the user's favorites items
        $favoritesItems = Auth::user()->favorites()->whereHas('product', function ($query) {
            $query->where('published', 1)->whereNull('deleted_at');
        })->get();

        return view('favorites.favorites', compact('favoritesItems'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'product_id' => 'required|exists:products,id',
    ]);

     // Check if the product already exists in user's favorites
     $existingFavorite = Auth::user()->favorites->where('product_id', $request->product_id)->first();

     if ($existingFavorite) {
         return back()->with('error', 'Produsul este deja în lista de favorite');
     } else {
         // Create a new favorites item and associate it with the user
         $newFavoritesItem = new Favorites([
             'product_id' => $request->product_id,
            ]);

            Auth::user()->favorites()->save($newFavoritesItem);
        }

    return back()->with('success', 'Produsul a fost adăugat în lista de favorite');
    }

    public function destroy($id)
    {
        $favoritesItem = Auth::user()->favorites->find($id);

        $favoritesItem->delete();

        return back()->with('success', 'Produsul a fost șters din lista de favorite.');

    }

    public function getFavoritesItemCount()
    {
        $itemCount = Favorites::whereHas('product', function ($query) {
            $query->where('published', 1)->whereNull('deleted_at');
        })->where('user_id', auth()->id())->count();

        return response()->json(['count' => $itemCount]);
    }
}
