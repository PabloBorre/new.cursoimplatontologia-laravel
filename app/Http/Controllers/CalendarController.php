<?php

namespace App\Http\Controllers;

use App\Models\CourseDate;

class CalendarController extends Controller
{
    public function getEvents()
    {
        $dates = CourseDate::available()
            ->whereHas('course', fn($q) => $q->where('is_active', true))
            ->with('course:id,title,slug,short_description')
            ->get();

        $events = $dates->map(function ($date) {
            $locationClass = str_contains(strtolower($date->location), 'per')
                ? 'calendar-event--peru'
                : 'calendar-event--default';

            return [
                'id'            => $date->id,
                'title'         => $date->course->title,
                'start'         => $date->start_date->toDateString(),
                'end'           => $date->end_date->addDay()->toDateString(),
                'url'           => url('cursos/' . $date->course->slug),
                'extendedProps' => [
                    'location'    => $date->location,
                    'spots'       => $date->spots_available,
                    'description' => $date->course->short_description ?? '',
                ],
                'className'     => $locationClass,
                'display'       => 'block',
            ];
        });

        return response()->json($events);
    }

    public function getLocations()
    {
        $locations = CourseDate::getLocations();

        return response()->json($locations);
    }
}