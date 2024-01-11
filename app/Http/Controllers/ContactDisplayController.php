<?php

namespace App\Http\Controllers;

use App\Repositories\ContactRepository;
use Illuminate\Contracts\View\View;

class ContactDisplayController extends Controller
{
    public function show( ContactRepository $pageRepository): View
    {
        $contact = $pageRepository->forSlug('contact');

        if (!$contact) {
            abort(404);
        }

        return view('site.contact', ['item' => $contact]);
    }
}
