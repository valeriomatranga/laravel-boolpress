<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\New_;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guests.welcome');
    }

    public function about()
    {
        return view('guests.about');
    }

    public function contacts()
    {
        return view('guests.contacts');
    }

    public function sendContactForm(Request $request)
    {
        $validateData = $request->validate([
            'full_name' => 'required',
            'email' => 'required | email',
            'message' => 'required'
        ]);
        Mail::to('admin@test.com')->send(new ContactFormMail($validateData));
        return redirect()
        ->back()
        ->with('message', 'Grazie per averci contattato, riceverai una risposta entro 48 ore');
    }
}
