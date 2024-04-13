<?php

namespace App\Http\Controllers;

use App\Repositories\EchipaRepository;
use Illuminate\Contracts\View\View;


class EchipaDisplayController extends Controller
{
    public function show_echipa( EchipaRepository $echipaRepository): View
    {
        $echipa = $echipaRepository->forSlug('echipa');

        if (! $echipa) {
            abort(404);
        }

        return view('site.echipa', ['item' => $echipa]);
    }

    public function show_despre_noi( EchipaRepository $echipaRepository): View
    {
        $despre_noi = $echipaRepository->forSlug('despre-noi');

        if (! $despre_noi) {
            abort(404);
        }

        return view('site.despre-noi', ['item' => $despre_noi]);
    }
    public function show_cariera( EchipaRepository $echipaRepository): View
    {
        $cariera = $echipaRepository->forSlug('cariera');

        if (! $cariera) {
            abort(404);
        }

        return view('site.cariera', ['item' => $cariera]);
    }
    public function show_intrebari_frecvente( EchipaRepository $echipaRepository): View
    {
        $intrebari_frecvente = $echipaRepository->forSlug('intrebari-frecvente');

        if (! $intrebari_frecvente) {
            abort(404);
        }

        return view('site.intrebari-frecvente', ['item' => $intrebari_frecvente]);
    }

    public function show_galerie( EchipaRepository $echipaRepository): View
    {
        $galerie = $echipaRepository->forSlug('galerie');

        if (! $galerie) {
            abort(404);
        }

        return view('site.galerie', ['item' => $galerie]);
    }
}
