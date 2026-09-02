<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Diploma;
use App\Models\Workshop;

class HomeController extends Controller
{
    public function __invoke()
    {
        $courses = Course::published()->latest()->take(3)->get();
        $diplomas = Diploma::published()->latest()->take(3)->get();
        $workshops = Workshop::published()->latest()->take(3)->get();

        return view('public.home', compact('courses', 'diplomas', 'workshops'));
    }
}
