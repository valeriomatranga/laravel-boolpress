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
        $validateData = $request->validate([
            'full_name' => 'required',
            'email' => 'required | email',
            'message' => 'required'
        ]);
        //salva nel database
        $contact = Contact::create($validateData);

        //return (new ContactFormMarkdown($contact))->render();

        Mail::to('admin@test.com')->send(new ContactFormMarkdown($contact));
        return redirect()
        ->back()
        ->with('message', 'Grazie per averci contattato, riceverai una risposta entro 48 ore');
    }
}
