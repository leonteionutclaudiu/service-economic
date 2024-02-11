<?php

namespace App\Http\Controllers;

use A17\Twill\Models\Tag;
use App\Models\Favorites;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductDisplayController extends Controller
{
    public function getCategories(): JsonResponse
    {
        $tags = Product::with('tags')
            ->whereHas('tags', function ($query) {
                $query->where('taggable_type', 'App\Models\Product');
            })
            ->get()
            ->pluck('tags')
            ->collapse()
            ->unique('id');

        return response()->json(['categories' => $tags]);
    }

    public function showProductsByTag(string $tagSlug)
    {
        $tag = Tag::where('slug', $tagSlug)->firstOrFail();

        $products = Product::whereHas('tags', function ($query) use ($tagSlug) {
            $query->where('taggable_type', '=', 'App\Models\Product')
                  ->where('slug', $tagSlug);
        })->where('published', 1)->paginate(12);

        // Verificați dacă utilizatorul este autentificat
        if (auth()->check()) {
            // Obțineți id-ul utilizatorului curent
            $userId = auth()->id();

            // Obțineți toate produsele favorite ale utilizatorului curent
            $favorites = DB::table('favorites')
            ->where('user_id', $userId)
            ->get();

        }

        return view('site.products', ['products' => $products, 'tag' => $tag, 'favorites'=> $favorites]);
    }

    public function showProduct(string $slug, ProductRepository $productRepository): View
    {
        $product = $productRepository->forSlug($slug);


        if (! $product) {
            abort(404);
        }

        if (auth()->check()) {
        $userId = auth()->id();

        $favorite = DB::table('favorites')
        ->where('product_id', $product->id)
        ->where('user_id', $userId)
        ->first();
    }

        return view('site.product', ['product' => $product, 'favorite' => $favorite]);
    }

    public function search(Request $request)
    {
        $searchInput = $request->input('search');

        if (empty($searchInput)) {
            return redirect()->back()->with('error', 'Campul pentru cautare este gol');
        }

        $products = Product::whereHas('translations', function ($query) use ($searchInput) {
            $query->where('title', 'like', "%{$searchInput}%");
        })->paginate(12);

        return view('site.search-results', compact('products', 'searchInput'));
    }
}
