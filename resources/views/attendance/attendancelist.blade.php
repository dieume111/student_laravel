<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #ADD8E6;
            min-height: 100vh;
        }

        .header {
            background: #22223b;
            padding: 15px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h2 {
            color: #f2e9e4;
            font-size: 1.5rem;
            margin: 0;
        }

        .nav-menu {
            display: flex;
            gap: 15px;
        }

        .nav-menu a {
            color: #f2e9e4;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .nav-menu a:hover {
            background: #4a4e69;
        }

        .btn-danger {
            background: #c94c4c;
        }

        .btn-danger:hover {
            background: #b43c3c;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        .attendance-form {
            background: #FFFFFF;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #22223b;
            font-weight: 500;
        }

        .form-group select,
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #9a8c98;
            color: #f2e9e4;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #8a7c88;
        }

        .attendance-table {
            width: 100%;
            background: #FFFFFF;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .attendance-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .attendance-table th,
        .attendance-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .attendance-table th {
            background: #22223b;
            color: #f2e9e4;
            font-weight: 500;
        }

        .attendance-table tr:hover {
            background: #f8f9fa;
        }

        .status-present {
            color: #27ae60;
        }

        .status-absent {
            color: #e74c3c;
        }

        .status-late {
            color: #f39c12;
        }

        .alert {
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>School Records System</h2>
        <div class="nav-menu">
            <a href="{{ route('dashboard') }}">Back to dashboard</a>
            
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="attendance-form">
            <h3>Mark Attendance</h3>
            <form action="{{ route('attendance.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="course_id">Select Course</label>
                    <select name="course_id" id="course_id" required>
                        <option value="">Select a course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="attendance_date">Date</label>
                    <input type="date" name="attendance_date" id="attendance_date" required value="{{ date('Y-m-d') }}">
                </div>

                <div class="attendance-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->First_name }} {{ $student->Last_name }}</td>
                                    <td>
                                        <select name="students[{{ $student->student_id }}][status]" required>
                                            <option value="present">Present</option>
                                            <option value="absent">Absent</option>
                                            <option value="late">Late</option>
                                        </select>
                                        <input type="hidden" name="students[{{ $student->student_id }}][student_id]" value="{{ $student->student_id }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn">Mark Attendance</button>
            </form>
        </div>

        <div class="attendance-table">
            <h3>Attendance Records</h3>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Student</th>
                        <th>Course</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->attendance_date }}</td>
                            <td>{{ $attendance->student->First_name }} {{ $attendance->student->Last_name }}</td>
                            <td>{{ $attendance->course->course_name }}</td>
                            <td class="status-{{ $attendance->status }}">{{ ucfirst($attendance->status) }}</td>
                            <td>
                                <form action="{{ route('attendance.update', $attendance->attendance_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="present" {{ $attendance->status == 'present' ? 'selected' : '' }}>Present</option>
                                        <option value="absent" {{ $attendance->status == 'absent' ? 'selected' : '' }}>Absent</option>
                                        <option value="late" {{ $attendance->status == 'late' ? 'selected' : '' }}>Late</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html> 