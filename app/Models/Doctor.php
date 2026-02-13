<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;

    protected $table = 'doctors';

    protected $fillable = [
        'slug',
        'full_name',
        'role_title',
        'image_path',
        'studies',
        'titles',
        'teaching_activity',
        'teaching_category',
        'clinical_research',
        'patents',
        'presentations',
        'publications',
        'courses_received',
        'courses_taught',
        'abroad_stays',
        'positions_held',
        'professional_experience',
        'scholarships_research_groups',
        'other_studies',
        'notes',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];
}