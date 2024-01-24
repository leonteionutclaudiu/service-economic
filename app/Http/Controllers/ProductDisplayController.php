<?php

namespace App\Http\Controllers;

use A17\Twill\Models\Tag;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $tag = Tag::where('slug', $tagSlug)->first();

        if (! $tag) {
            abort(404);
        }

        $products = Product::whereHas('tags', function ($query) use ($tagSlug) {
            $query->where('taggable_type', '=', 'App\Models\Product')
                ->where('slug', $tagSlug);
        })->paginate(12);

        return view('site.products', ['products' => $products, 'tag' => $tag]);
    }

    public function showProduct(string $slug, ProductRepository $productRepository): View
    {
        $product = $productRepository->forSlug($slug);

        if (! $product) {
            abort(404);
        }

        return view('site.product', ['product' => $product]);
    }

    public function search(Request $request)
    {
        $searchInput = $request->input('search');

        if (empty($searchInput)) {
            return redirect()->back()->with('error', 'Campul pentru cautare este gol !');
        }

        $products = Product::whereHas('translations', function ($query) use ($searchInput) {
            $query->where('title', 'like', "%{$searchInput}%");
        })->paginate(12);

        return view('site.search-results', compact('products', 'searchInput'));
    }
}
