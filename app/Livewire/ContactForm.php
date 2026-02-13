<?php

namespace App\Livewire;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public string $nombre = '';
    public string $email = '';
    public string $telefono = '';
    public string $mensaje = '';
    public bool $sent = false;

    protected function rules(): array
    {
        return [
            'nombre'   => 'required|min:3|max:120',
            'email'    => 'required|email',
            'telefono' => 'nullable|max:30',
            'mensaje'  => 'required|min:10|max:2000',
        ];
    }

    public function enviar()
    {
        $data = $this->validate();

        Mail::to('info@cursodeimplantologia.com')->send(new ContactMail($data));

        $this->reset(['nombre', 'email', 'telefono', 'mensaje']);
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}