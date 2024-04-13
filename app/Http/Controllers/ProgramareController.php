<?php

namespace App\Http\Controllers;

use App\Mail\ContactClientMail;
use App\Mail\ProgramareAdminMail;
use App\Models\Programare;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProgramareController extends Controller
{
    public function showForm()
    {
        return view('programari.programare');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'nume' => 'required|string',
            'email' => 'required|email',
            'nr' => 'required',
            'nr_inmatriculare' => 'required',
            'mesaj' => 'required',
            'data_programare' => 'required',
            'g-recaptcha-response' => 'required|recaptcha',
        ], [
            'nume.required' => 'Câmpul nume este obligatoriu.',
            'email.required' => 'Câmpul email este obligatoriu.',
            'email.email' => 'Adresa de email introdusă nu este validă.',
            'nr.required' => 'Câmpul telefon este obligatoriu.',
            'nr_inmatriculare.required' => 'Câmpul număr înmatriculare este obligatoriu.',
            'mesaj.required' => 'Câmpul mesaj este obligatoriu.',
            'data_programare.required' => 'Câmpul dată programare este obligatoriu.',
            'g-recaptcha-response.recaptcha' => 'Verificarea Captcha a esuat.',
            'g-recaptcha-response.required' => 'Va rugam completati Captcha.',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Send email to client email address provided in the form
        $data = $request->all();
        $data['acceptata'] = false;

        Programare::create($data);

        $data['data_programare'] = Carbon::parse($request->data_programare)->locale('ro_RO')->translatedFormat('d F Y');

        Mail::to($data['email'])->send(new ContactClientMail($data));

        // Send email to admin email
        Mail::to(['leonteionut98@yahoo.com', 'catalin.coman@serviceeconomic.ro', 'office@serviceeconomic.ro', 'rares.nemet@serviceeconomic.ro', 'radu.ivascu@serviceeconomic.ro'])->send(new ProgramareAdminMail($data));

        // Session::flash('success', 'Mesajul dvs. a fost trimis cu succes');

        return response()->json(['message' => 'Multumim! Mesajul a fost trimis cu succes!']);
    }

    public function showProgramari(Request $request)
    {
        $sortBy = $request->query('sort', 'created_at');
        $sortOrder = $request->query('order', 'desc');

        $programari = Programare::orderBy($sortBy, $sortOrder)->paginate(20);

        return view('programari.programari', compact('programari', 'sortBy', 'sortOrder'));
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
