<?php

namespace App\Http\Controllers;

use App\Models\Noutati;
use App\Repositories\NoutatiRepository;
use Illuminate\Contracts\View\View;

class NoutatiDisplayController extends Controller
{
    public function index()
    {

        $noutati = Noutati::orderBy('updated_at', 'desc')->paginate(12);

        return view('site.noutati-all', ['noutati' => $noutati]);
    }

    public function show(string $slug, NoutatiRepository $noutatiRepository): View
    {
        $noutate = $noutatiRepository->forSlug($slug);

        if (! $noutate) {
            abort(404);
        }

        return view('site.noutate', ['item' => $noutate]);
    }
}
