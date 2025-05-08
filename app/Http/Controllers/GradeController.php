<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'course'])
            ->orderBy('exam_date', 'desc')
            ->get();
        $students = Student::all();
        $courses = Course::all();
        
        return view('grades.gradelist', compact('grades', 'students', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,student_id',
            'course_id' => 'required|exists:courses,course_id',
            'exam_date' => 'required|date',
            'marks' => 'required|integer|min:0|max:100'
        ]);

        Grade::create($validated);

        return redirect()->route('grades.index')
            ->with('success', 'Grade assigned successfully');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'marks' => 'required|integer|min:0|max:100'
        ]);

        $grade = Grade::findOrFail($id);
        $grade->update($validated);

        return redirect()->route('grades.index')
            ->with('success', 'Grade updated successfully');
    }

    public function filter(Request $request)
    {
        $query = Grade::with(['student', 'course']);
        $students = Student::all();
        $courses = Course::all();

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('exam_date', $request->date);
        }

        $grades = $query->orderBy('exam_date', 'desc')->get();

        return view('grades.gradelist', compact('grades', 'courses', 'students'));
    }

    public function view(Request $request)
    {
        $query = Grade::with(['student', 'course']);
        $students = Student::all();
        $courses = Course::all();

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('exam_date', $request->date);
        }

        $grades = $query->orderBy('exam_date', 'desc')->get();

        // Calculate statistics
        $stats = [
            'average' => $grades->avg('marks'),
            'highest' => $grades->max('marks'),
            'lowest' => $grades->min('marks'),
            'total' => $grades->count()
        ];

        return view('grades.gradeview', compact('grades', 'courses', 'students', 'stats'));
    }
}
