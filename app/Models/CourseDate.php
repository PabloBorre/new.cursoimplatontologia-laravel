<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseDate extends Model
{
    protected $table = 'course_dates';

    protected $fillable = [
        'course_id',
        'location',
        'start_date',
        'end_date',
        'spots_available',
        'is_available',
    ];

    protected $casts = [
        'course_id'       => 'integer',
        'start_date'      => 'date',
        'end_date'        => 'date',
        'spots_available' => 'integer',
        'is_available'    => 'boolean',
    ];

    // Relaciones

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function dates()
    {
        return $this->hasMany(CourseDate::class);
    }
    
    // Scopes

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)
                     ->where('start_date', '>=', now()->toDateString())
                     ->orderBy('start_date');
    }

    public function scopeForCourse($query, int $courseId)
    {
        return $query->available()->where('course_id', $courseId);
    }

    public function scopeByLocation($query, string $location)
    {
        return $query->available()->where('location', $location);
    }

    // Helpers

    public static function getLocations()
    {
        return static::where('is_available', true)
                     ->distinct()
                     ->pluck('location');
    }

    public static function formatDateRange(string $startDate, string $endDate): string
    {
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);

        if ($start->format('F Y') === $end->format('F Y')) {
            return $start->format('F j') . '-' . $end->format('j, Y');
        }

        return $start->format('F j') . ' - ' . $end->format('F j, Y');
    }

    public static function formatDateShort(string $startDate, string $endDate): string
    {
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);

        return $start->format('M j') . '-' . $end->format('j');
    }
}