<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance - School Records System</title>
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
            background: #22223b;
            padding: 15px 20px;
            border-radius: 8px;
        }
        .header h2 {
            color: #f2e9e4;
            margin: 0;
        }
        .nav-menu {
            display: flex;
            gap: 15px;
        }
        .nav-menu a {
            text-decoration: none;
            color: #f2e9e4;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .nav-menu a:hover {
            background-color: #4a4e69;
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
            background-color: #9a8c98;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #8a7c88;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #22223b;
            color: #f2e9e4;
            font-weight: 500;
        }
        tr:hover {
            background-color: #f8f9fa;
        }
        .status-present {
            color: #28a745;
            font-weight: bold;
        }
        .status-absent {
            color: #dc3545;
            font-weight: bold;
        }
        .status-late {
            color: #ffc107;
            font-weight: bold;
        }
        .summary-section {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }
        .summary-card {
            background-color: white;
            padding: 15px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            text-align: center;
        }
        .summary-card h4 {
            margin: 0 0 10px 0;
            color: #22223b;
        }
        .summary-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #9a8c98;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Attendance View</h2>
            <div class="nav-menu">
                <a href="{{ route('dashboard') }}">Back to Dashboard</a>
                <a href="{{ route('attendance.index') }}">Manage Attendance</a>
            </div>
        </div>

        <div class="filter-section">
            <h3>Filter Attendance</h3>
            <form action="{{ route('attendance.view') }}" method="GET" class="filter-form">
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
                                {{ $student->first_name }} {{ $student->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" value="{{ request('date') }}">
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status">
                        <option value="">All Status</option>
                        <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Present</option>
                        <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                        <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Late</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit">Apply Filters</button>
                </div>
            </form>
        </div>

        <div class="summary-section">
            <h3>Attendance Summary</h3>
            <div class="summary-grid">
                <div class="summary-card">
                    <h4>Present Today</h4>
                    <div class="summary-number">{{ $stats['present'] ?? 0 }}</div>
                </div>
                <div class="summary-card">
                    <h4>Absent Today</h4>
                    <div class="summary-number">{{ $stats['absent'] ?? 0 }}</div>
                </div>
                <div class="summary-card">
                    <h4>Late Today</h4>
                    <div class="summary-number">{{ $stats['late'] ?? 0 }}</div>
                </div>
                <div class="summary-card">
                    <h4>Total Records</h4>
                    <div class="summary-number">{{ $stats['total'] ?? 0 }}</div>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Student Name</th>
                    <th>Course</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('Y-m-d') }}</td>
                        <td>{{ $attendance->student->first_name }} {{ $attendance->student->last_name }}</td>
                        <td>{{ $attendance->course->course_name }}</td>
                        <td class="status-{{ $attendance->status }}">{{ ucfirst($attendance->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
