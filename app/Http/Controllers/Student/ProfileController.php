<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit(Request $request)
    {
        return view('student.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the authenticated student's profile.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'last_name'          => 'required|string|max:255',
            'email'              => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone'              => 'nullable|string|max:30',
            'previous_experience'=> 'nullable|string|max:5000',
            'dental_clinic_name' => 'nullable|string|max:255',
            'position'           => 'nullable|string|max:255',
            'documentation'      => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'diploma'            => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'dental_license'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        // Handle file uploads — replace old files if new ones are uploaded
        foreach (['documentation', 'diploma', 'dental_license'] as $fileField) {
            if ($request->hasFile($fileField)) {
                // Delete old file
                if ($user->$fileField && Storage::disk('public')->exists($user->$fileField)) {
                    Storage::disk('public')->delete($user->$fileField);
                }
                $folder = match ($fileField) {
                    'documentation' => 'users/documentation',
                    'diploma'       => 'users/diplomas',
                    'dental_license'=> 'users/dental-licenses',
                };
                $validated[$fileField] = $request->file($fileField)->store($folder, 'public');
            } else {
                unset($validated[$fileField]);
            }
        }

        $user->update($validated);

        return redirect()->route('student.profile.edit')
            ->with('success', __('Profile updated successfully.'));
    }
}