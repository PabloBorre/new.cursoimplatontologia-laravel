<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    // ── Accessors ───────────────────────────────────────────────

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->name} {$this->last_name}";
    }

    // ── Relationships ───────────────────────────────────────────

    /**
     * Courses the user is enrolled in.
     */
    public function enrollments(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'enrollments')
            ->withPivot(['status', 'payment_id', 'amount_paid', 'enrolled_at'])
            ->withTimestamps();
    }
}
