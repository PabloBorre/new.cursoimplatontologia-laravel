<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuxiliaryCourse extends Model
{
    protected $table = 'auxiliary_courses';

    protected $fillable = [
        'slug',
        'title',
        'description',
        'price',
        'currency',
        'is_active',
    ];

    protected $casts = [
        'price'     => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Scopes

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeBySlug($query, string $slug)
    {
        return $query->active()->where('slug', $slug);
    }
}