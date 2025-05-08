<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('student.studentlist', compact('students'));
    }
    public function create()
    {
        return view('student.addstudent');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'First_name' => 'required|string',
            'Last_name' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'contact_no' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'address' => 'required|string',
            'date_of_birth' => 'required|date',
        ]);
        Student::create($validated);
        return redirect()->route('students.index')->with('success', 'Student added successfully');
    }

}   
