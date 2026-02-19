<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, mixed>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            // Required fields
            'name'                => ['required', 'string', 'max:255'],
            'last_name'           => ['required', 'string', 'max:255'],
            'email'               => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'phone'               => ['required', 'string', 'max:30'],
            'previous_experience' => ['required', 'string', 'max:5000'],
            'password'            => ['required', 'string', 'confirmed', 'regex:/^\S+$/', \Illuminate\Validation\Rules\Password::min(8)->letters()->numbers()],

            // File uploads
            'documentation'       => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
            'diploma'             => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
            'dental_license'      => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],

            // Optional fields
            'dental_clinic_name'  => ['nullable', 'string', 'max:255'],
            'position'            => ['nullable', 'string', 'max:255'],
        ])->validate();

        // Store uploaded files
        $documentationPath = $input['documentation']->store('users/documentation', 'public');
        $diplomaPath       = $input['diploma']->store('users/diplomas', 'public');
        $dentalLicensePath = $input['dental_license']->store('users/dental-licenses', 'public');

        $user = User::create([
            'name'                => $input['name'],
            'last_name'           => $input['last_name'],
            'email'               => $input['email'],
            'phone'               => $input['phone'],
            'previous_experience' => $input['previous_experience'],
            'password'            => Hash::make($input['password']),
            'role'                => 'student',

            // File paths
            'documentation'       => $documentationPath,
            'diploma'             => $diplomaPath,
            'dental_license'      => $dentalLicensePath,

            // Optional
            'dental_clinic_name'  => $input['dental_clinic_name'] ?? null,
            'position'            => $input['position'] ?? null,
        ]);

        // Send welcome email
        try {
            Mail::to($user->email)->send(new WelcomeEmail($user));
        } catch (\Exception $e) {
            \Log::error("Failed to send welcome email to {$user->email}: " . $e->getMessage());
        }

        return $user;
    }
}