<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
   public function index()
   {
       $courses = Course::all();
       return view('course.viewcourse', compact('courses'));
   }
   public function create()
   {
       return view('course.addcourse');
   }
   public function store(Request $request)
   {
       $validated = $request->validate([
           'course_name' => 'required|string',
           'duration' => 'required|string',
           'description' => 'nullable|string',
       ]);
       Course::create($validated);
       return redirect()->route('courses.index')->with('success', 'Course added successfully');
   }
}
