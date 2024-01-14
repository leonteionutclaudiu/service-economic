<?php

namespace App\Http\Controllers;

use App\Repositories\HomeRepository;
use Illuminate\Contracts\View\View;


class HomeDisplayController extends Controller
{
    public function show(HomeRepository $homeRepository): View
    {
        $home = $homeRepository->forSlug('acasa');

        if (! $home) {
            abort(404);
        }

        return view('site.home', ['item' => $home]);
    }
}
