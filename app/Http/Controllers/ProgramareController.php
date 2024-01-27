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
            'telefon' => 'required|string',
            'nr_inmatriculare' => 'required|string',
            'mesaj' => 'nullable|string',
            'data_programare' => 'required',
        ]);

        $validatedData['acceptata'] = false;

        Programare::create($validatedData);

        return redirect('/acasa')->with('success', 'Programarea a fost înregistrată cu succes');
    }

    public function showProgramari()
{
    $programari = Programare::latest()->get();

    return view('programari.programari', compact('programari'));
}
public function updateAcceptata(Request $request, Programare $programare)
{
    if (!auth()->user()->hasRole('admin')) {
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
