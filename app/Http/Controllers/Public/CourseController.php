<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::published()->with('category');

        if ($request->filled('q')) {
            $query->where('title', 'ilike', '%' . $request->q . '%');
        }

        if ($request->filled('categoria')) {
            $query->whereHas('category', fn ($c) => $c->where('slug', $request->categoria));
        }

        $courses = $query->latest()->paginate(9)->withQueryString();
        $categories = Category::ofType('course')->orWhere('type', 'general')->get();

        return view('public.courses.index', compact('courses', 'categories'));
    }

    public function show(Course $course)
    {
        abort_unless($course->status === 'published', 404);

        $course->load(['modules', 'moodleLink']);

        return view('public.courses.show', compact('course'));
    }
}
