<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Management</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .nav-menu {
            display: flex;
            gap: 15px;
        }
        .nav-menu a {
            text-decoration: none;
            color: #333;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .nav-menu a:hover {
            background-color: #f0f0f0;
        }
        .nav-menu a.active {
            background-color: #007bff;
            color: white;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        select, input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .filter-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .filter-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Grade Management System</h2>
            <div class="nav-menu">
                <a href="{{ route('dashboard') }}">Back to dashboard</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="filter-section">
            <h3>Filter Grades</h3>
            <form action="{{ route('grades.filter') }}" method="GET" class="filter-form">
                <div class="form-group">
                    <label for="course_id">Course</label>
                    <select name="course_id" id="course_id">
                        <option value="">All Courses</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->course_id }}" {{ request('course_id') == $course->course_id ? 'selected' : '' }}>
                                {{ $course->course_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="student_id">Student</label>
                    <select name="student_id" id="student_id">
                        <option value="">All Students</option>
                        @foreach($students as $student)
                            <option value="{{ $student->student_id }}" {{ request('student_id') == $student->student_id ? 'selected' : '' }}>
                                {{ $student->Larst_name }} {{ $student->Last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="date">Exam Date</label>
                    <input type="date" name="date" id="date" value="{{ request('date') }}">
                </div>

                <div class="form-group">
                    <button type="submit">Filter</button>
                </div>
            </form>
        </div>

        <h3>Assign New Grade</h3>
        <form action="{{ route('grades.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="student_id">Student</label>
                <select name="student_id" id="student_id" required>
                    <option value="">Select Student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->student_id }}">
                            {{ $student->First_name }} {{ $student->Last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="course_id">Course</label>
                <select name="course_id" id="course_id" required>
                    <option value="">Select Course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->course_id }}">
                            {{ $course->course_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exam_date">Exam Date</label>
                <input type="date" name="exam_date" id="exam_date" required>
            </div>

            <div class="form-group">
                <label for="marks">Marks (0-100)</label>
                <input type="number" name="marks" id="marks" min="0" max="100" required>
            </div>

            <button type="submit">Assign Grade</button>
        </form>

        <h3>Grade List</h3>
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Exam Date</th>
                    <th>Marks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $grade)
                    <tr>
                        <td>{{ $grade->student->First_name }} {{ $grade->student->Last_name }}</td>
                        <td>{{ $grade->course->course_name }}</td>
                        <td>{{ $grade->exam_date->format('Y-m-d') }}</td>
                        <td>{{ $grade->marks }}</td>
                        <td>
                            <form action="{{ route('grades.update', $grade->grade_id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <input type="number" name="marks" value="{{ $grade->marks }}" min="0" max="100" style="width: 60px;">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html> 