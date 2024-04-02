<?php

namespace App\Http\Controllers;

use App\Repositories\LegalRepository;
use Illuminate\Contracts\View\View;

class LegalDisplayController extends Controller
{
    public function show_cookies( LegalRepository $legalRepository): View
    {
        $cookies = $legalRepository->forSlug('cookies');

        if (! $cookies) {
            abort(404);
        }

        return view('site.legal', ['item' => $cookies]);
    }
    public function show_terms( LegalRepository $legalRepository): View
    {
        $terms = $legalRepository->forSlug('termeni-si-conditii');

        if (! $terms) {
            abort(404);
        }

        return view('site.legal', ['item' => $terms]);
    }
    public function show_confidentialitate( LegalRepository $legalRepository): View
    {
        $confidentialitate = $legalRepository->forSlug('politica-de-confidentialitate');

        if (! $confidentialitate) {
            abort(404);
        }

        return view('site.legal', ['item' => $confidentialitate]);
    }
}
