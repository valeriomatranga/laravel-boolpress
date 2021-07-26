<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Mail\ContactFormMarkdown;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function form()
    {
        return view('guests.contacts');
    }

    public function storeAndSend(Request $request)
    {
        //ddd($request->all());

        #Valida i dati
        $validateData = $request->validate([
            'full_name' => 'required',
            'email' => 'required | email',
            'message' => 'required'
        ]);
        //ddd($validateData);

        #Salva nel database
        $contact = Contact::create($validateData);
        //ddd($contact);

        #Invia la mail
        //Mail::to('admin@test.com')->send(new ContactFormMarkdown($contact));
        Mail::to('admin@test.com')->send(new ContactFormMail($validateData));
        return redirect()
        ->back()
        ->with('message', 'Grazie per averci contattato, riceverai una risposta entro 48 ore');
    }
}
