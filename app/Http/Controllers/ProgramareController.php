<?php

namespace App\Http\Controllers;

use App\Models\Programare;
use Illuminate\Http\Request;

class ProgramareController extends Controller
{
    public function showForm()
    {
        return view('programari.programare');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nume' => 'required|string',
            'email' => 'required|email',
            'telefon' => 'required',
            'nr_inmatriculare' => 'required',
            'mesaj' => 'required',
            'data_programare' => 'required',
        ], [
            'nume.required' => 'Câmpul nume este obligatoriu.',
            'email.required' => 'Câmpul email este obligatoriu.',
            'email.email' => 'Adresa de email introdusă nu este validă.',
            'telefon.required' => 'Câmpul telefon este obligatoriu.',
            'nr_inmatriculare.required' => 'Câmpul număr înmatriculare este obligatoriu.',
            'mesaj.required' => 'Câmpul mesaj este obligatoriu.',
            'data_programare.required' => 'Câmpul dată programare este obligatoriu.',
        ]);

        $validatedData['acceptata'] = false;

        Programare::create($validatedData);

        return redirect('/')->with('success', 'Programarea a fost înregistrată cu succes');
    }

    public function showProgramari()
    {
        $programari = Programare::latest()->get();

        return view('programari.programari', compact('programari'));
    }

    public function updateAcceptata(Request $request, Programare $programare)
    {
        if (! auth()->user()->hasRole('admin')) {
            return redirect()->back()->with('error', 'Nu aveți permisiunea de a actualiza starea programării.');
        }

        $request->validate([
            'acceptata' => 'required|boolean',
        ]);

        $programare->update([
            'acceptata' => $request->acceptata,
        ]);

        return redirect()->back()->with('success', 'Starea programării a fost actualizată cu succes.');
    }
}
