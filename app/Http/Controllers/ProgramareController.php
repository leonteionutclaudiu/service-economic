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
        ]);

        Programare::create($validatedData);

        return redirect('/acasa')->with('success', 'Programarea a fost înregistrată cu succes');
    }

    public function showProgramari()
{
    $programari = Programare::all();

    return view('programari.programari', compact('programari'));
}
}
