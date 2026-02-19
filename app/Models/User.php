<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
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

    // ── Custom Notifications (branded emails) ───────────────

    /**
     * Send the email verification notification (branded).
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmailNotification());
    }

    /**
     * Send the password reset notification (branded).
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
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
            ->where('status', 'paid')
            ->exists();
    }
}