<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'slug',
        'level',
        'title',
        'subtitle',
        'short_description',
        'hero_image',
        'content_image',
        'price',
        'currency',
        'duration_days',
        'features',
        'requirements',
        'includes',
        'meta_title',
        'meta_description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'level'         => 'integer',
        'price'         => 'decimal:2',
        'duration_days' => 'integer',
        'features'      => 'array',
        'requirements'  => 'array',
        'includes'      => 'array',
        'is_active'     => 'boolean',
        'sort_order'    => 'integer',
    ];

    // Scopes

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeByLevel($query, int $level)
    {
        return $query->active()->where('level', $level);
    }

    public function scopeBySlug($query, string $slug)
    {
        return $query->active()->where('slug', $slug);
    }

    // Helpers

    public static function getLevelName(int $level): string
    {
        $levels = [
            1 => 'Level 1 - Foundation',
            2 => 'Level 2 - Intermediate',
            3 => 'Level 3 - Advanced',
        ];

        return $levels[$level] ?? 'Unknown Level';
    }

    public static function formatPrice(float $price, string $currency = 'EUR'): string
    {
        $symbols = [
            'EUR' => '€',
            'USD' => '$',
            'GBP' => '£',
        ];

        $symbol = $symbols[$currency] ?? $currency;

        return $symbol . number_format($price, 0, ',', '.');
    }

    public static function getCoursesGroupedByLevel()
    {
        return static::active()->get()->groupBy('level');
    }
}