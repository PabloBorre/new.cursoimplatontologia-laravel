<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes;

    protected $table = 'testimonials';

    protected $fillable = [
        'name',
        'country',
        'image_path',
        'video_path',
    ];

    public function scopeActive($query)
    {
        return $query->latest('created_at');
    }

    public function scopeHomepage($query, int $limit = 6)
    {
        return $query->active()->limit($limit);
    }
}