<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ContactFormController extends Controller
{
    public function submitForm(Request $request)
    {
        // Validate the form data
        $request->validate([
            'nume' => 'required|min:3',
            'nr' => 'required|regex:/^[0-9]{10}$/u',
            // 'companie' => 'required|min:3',
            'judet' => 'required|min:3',
            'email' => 'required|email|max:255',
            'mesaj' => 'required|min:5',
            'g-recaptcha-response' => 'required|recaptcha',
            'privacy_policy' => 'required',
        ], [
            'nume.required' => 'Campul nume este obligatoriu.',
            'nume.min' => 'Campul nume trebuie să aibă cel puțin 3 caractere.',
            'nr.required' => 'Campul telefon este obligatoriu.',
            'nr.regex' => 'Introduceți un număr de telefon valid (10 cifre).',
            // 'companie.required' => 'Campul companie este obligatoriu.',
            // 'companie.min' => 'Campul companie trebuie să aibă cel puțin 3 caractere.',
            'judet.required' => 'Campul judet este obligatoriu.',
            'judet.min' => 'Campul judet trebuie să aibă cel puțin 3 caractere.',
            'email.required' => 'Campul email este obligatoriu.',
            'email.email' => 'Introduceti o adresa de email valida.',
            'email.max' => 'Campul email nu poate avea mai mult de 255 de caractere.',
            'mesaj.required' => 'Campul mesaj este obligatoriu.',
            'mesaj.min' => 'Campul mesaj trebuie să aibă cel puțin 5 caractere.',
            'g-recaptcha-response.recaptcha' => 'Verificarea Captcha a esuat.',
            'g-recaptcha-response.required' => 'Va rugam completati Captcha.',
            'privacy_policy.required' => 'Trebuie sa fiti de acord cu politica de confidentialitate.',
        ]);

        // Send email using Bcc to leonteionut98@yahoo.com and the email address provided in the form
        $data = $request->all();
        Mail::to($data['email'])->bcc('leonteionut98@yahoo.com')->send(new ContactFormMail($data));

        Session::flash('success_message', 'Mesajul dvs. a fost trimis cu succes');

        return redirect()->back()->with('success', 'Formularul a fost trimis cu succes');
    }
}
