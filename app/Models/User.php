<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'role',
        'phone',
        'previous_experience',
        'documentation',
        'diploma',
        'dental_license',
        'dental_clinic_name',
        'position',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ── Role Helpers ────────────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    // ── Accessors ───────────────────────────────────────────

    public function getFullNameAttribute(): string
    {
        return "{$this->name} {$this->last_name}";
    }

    /**
     * Get the user's initials (for Flux avatar).
     */
    public function initials(): string
    {
        $name = trim($this->name . ' ' . ($this->last_name ?? ''));

        return collect(explode(' ', $name))
            ->map(fn (string $segment) => strtoupper(mb_substr($segment, 0, 1)))
            ->take(2)
            ->join('');
    }

    // ── Relationships ───────────────────────────────────────

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Check if user is enrolled in a specific course.
     */
    public function isEnrolledIn(int $courseId): bool
    {
        return $this->enrollments()
            ->where('course_id', $courseId)
            ->whereIn('status', ['paid', 'pending'])
            ->exists();
    }
}