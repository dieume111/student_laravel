<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Course;

class AttendanceController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $courses = Course::all();
        $attendances = Attendance::with(['student', 'course'])
            ->orderBy('attendance_date', 'desc')
            ->get();
        return view('attendance.attendancelist', compact('students', 'courses', 'attendances'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,course_id',
            'attendance_date' => 'required|date',
            'students' => 'required|array',
            'students.*.student_id' => 'required|exists:students,student_id',
            'students.*.status' => 'required|in:present,absent,late'
        ]);

        foreach ($validated['students'] as $student) {
            Attendance::create([
                'student_id' => $student['student_id'],
                'course_id' => $validated['course_id'],
                'attendance_date' => $validated['attendance_date'],
                'status' => $student['status']
            ]);
        }

        return redirect()->route('attendance.index')->with('success', 'Attendance marked successfully');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:present,absent,late'
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->update($validated);

        return redirect()->route('attendance.index')->with('success', 'Attendance updated successfully');
    }

    public function filter(Request $request)
    {
        $query = Attendance::with(['student', 'course']);
        $students = Student::all();
        $courses = Course::all();

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('attendance_date', $request->date);
        }

        $attendances = $query->orderBy('attendance_date', 'desc')->get();

        return view('attendance.attendancelist', compact('attendances', 'courses', 'students'));
    }

    public function showstudent()
    {
        return view('student.addstudent');
    }

    public function view(Request $request)
    {
        $query = Attendance::with(['student', 'course']);
        $students = Student::all();
        $courses = Course::all();

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('attendance_date', $request->date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $attendances = $query->orderBy('attendance_date', 'desc')->get();

        // Calculate statistics
        $stats = [
            'present' => $attendances->where('status', 'present')->count(),
            'absent' => $attendances->where('status', 'absent')->count(),
            'late' => $attendances->where('status', 'late')->count(),
            'total' => $attendances->count()
        ];

        return view('attendance.attendanceview', compact('attendances', 'courses', 'students', 'stats'));
    }
}