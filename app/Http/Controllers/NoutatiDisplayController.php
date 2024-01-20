<?php

namespace App\Http\Controllers;

use App\Models\Noutati;
use App\Repositories\NoutatiRepository;
use Illuminate\Contracts\View\View;

class NoutatiDisplayController extends Controller
{
    public function index()
    {

        $noutati = Noutati::orderBy('updated_at', 'desc')->paginate(9);

        return view('site.noutati-all', ['noutati' => $noutati]);
    }

    public function show(string $slug, NoutatiRepository $noutatiRepository): View
    {
        $noutate = $noutatiRepository->forSlug($slug);

        if (!$noutate) {
            abort(404);
        }

        $noutatiRelevante = Noutati::inRandomOrder()
            ->where('id', '!=', $noutate->id)
            ->take(3)
            ->get();

        return view('site.noutate', ['item' => $noutate, 'noutatiRelevante' => $noutatiRelevante]);
    }
}
