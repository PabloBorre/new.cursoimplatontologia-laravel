<?php

namespace App\Livewire;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public string $nombre   = '';
    public string $email    = '';
    public string $telefono = '';
    public string $mensaje  = '';
    public string $recaptchaToken = ''; // ← nuevo
    public bool   $sent     = false;

    protected function rules(): array
    {
        return [
            'nombre'          => 'required|min:3|max:120',
            'email'           => 'required|email',
            'telefono'        => 'nullable|max:30',
            'mensaje'         => 'required|min:10|max:2000',
            'recaptchaToken'  => 'required', // ← nuevo
        ];
    }

    public function enviar()
    {
        $this->validate();

        // Verificar token con Google
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => config('services.recaptcha.secret_key'),
            'response' => $this->recaptchaToken,
        ]);

        $score = $response->json('score', 0);

        if (! $response->json('success') || $score < 0.5) {
            $this->addError('recaptchaToken', 'Security check failed. Please try again.');
            return;
        }

        $data = [
            'nombre'   => $this->nombre,
            'email'    => $this->email,
            'telefono' => $this->telefono,
            'mensaje'  => $this->mensaje,
        ];

        Mail::to('info@cursodeimplantologia.com')->send(new ContactMail($data));

        $this->reset(['nombre', 'email', 'telefono', 'mensaje', 'recaptchaToken']);
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}