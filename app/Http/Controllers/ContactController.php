<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function enviar(ContactRequest $request)
    {
        $data = $request->validated();

        Mail::to('desarrollo@capazero.es')->send(new ContactMail($data));

        return back()->with('success', 'Message sent successfully.');
    }
}