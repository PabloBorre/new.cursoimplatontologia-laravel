<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display full student details.
     */
    public function show(User $student)
    {
        $student->load(['enrollments.course']);

        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing a student.
     */
    public function edit(User $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified student.
     */
    public function update(Request $request, User $student)
    {
        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'last_name'          => 'required|string|max:255',
            'email'              => 'required|email|max:255|unique:users,email,' . $student->id,
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
                if ($student->$fileField && Storage::disk('public')->exists($student->$fileField)) {
                    Storage::disk('public')->delete($student->$fileField);
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

        $student->update($validated);

        return redirect()->route('admin.students.show', $student)
            ->with('success', 'Student updated successfully.');
    }
}