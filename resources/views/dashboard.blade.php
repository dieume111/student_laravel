<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - School Records System</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            align-items: center;
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

        .btn-info {
            background: #9a8c98;
        }

        .btn-info:hover {
            background: #8a7c88;
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

        .container h1 {
            font-size: 2rem;
            color: #22223b;
            text-align: center;
            margin-bottom: 10px;
        }

        .container p {
            font-size: 1.2rem;
            color: #4a4e69;
            text-align: center;
            margin-bottom: 20px;
        }

        .alert {
            background: #FFFFFF;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .alert-danger {
            border-left: 4px solid #c94c4c;
            color: #c94c4c;
        }

        .btn-warning {
            display: inline-block;
            padding: 8px 15px;
            background: #e6b800;
            color: #22223b;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .btn-warning:hover {
            background: #cc9900;
        }

        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .dashboard-card {
            background: #FFFFFF;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        .dashboard-card h3 {
            font-size: 1.25rem;
            color: #22223b;
            margin: 0 0 10px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #9a8c98;
            margin: 0 0 15px;
        }

        .btn-primary {
            display: inline-block;
            padding: 10px 20px;
            background: #9a8c98;
            color: #f2e9e4;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: #8a7c88;
        }

        .logout-form {
            display: inline-block;
            margin: 0;
            padding: 0;
        }

        .logout-button {
            background: #c94c4c;
            color: #f2e9e4;
            border: none;
            padding: 8px 15px;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .logout-button:hover {
            background: #b43c3c;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 10px;
            }

            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
            }

            .container {
                padding: 10px;
            }

            .container h1 {
                font-size: 1.5rem;
            }

            .dashboard-card {
                padding: 15px;
            }

            .stat-number {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>School Records System</h2>
        <div class="nav-menu">
            <a href="{{ route('dashboard') }}" class="btn-info">Home</a>
            <a href="{{route('students.index')}}">Student List</a>
            <a href="{{route('courses.index')}}">Courses</a>
            <a href="{{route('attendance.view')}}">Attendance</a>
            <a href="{{route('grades.view')}}">Grades</a>
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
        <h1>Welcome to School Records System</h1>
        <p>Welcome, {{ auth()->user()->user_name }}!</p>

        <div class="dashboard">
            <div class="dashboard-card">
                <h3>Total Students</h3>
                <p class="stat-number">{{ $stats['students'] ?? 0 }}</p>
                <a href="{{route('students.create')}}" class="btn btn-primary">Add Students</a>
            </div>

            <div class="dashboard-card">
                <h3>Total Courses</h3>
                <p class="stat-number">{{ $stats['courses'] ?? 0 }}</p>
                <a href="{{route('courses.create')}}" class="btn btn-primary">Manage Courses</a>
            </div>

            <div class="dashboard-card">
                <h3>Today's Attendance</h3>
                <p class="stat-number">{{ $stats['attendance'] ?? 0 }}</p>
                <a href="{{route('attendance.index')}}" class="btn btn-primary">Make Attendance</a>
            </div>

            <div class="dashboard-card">
                <h3>Grades Recorded</h3>
                <p class="stat-number">{{ $stats['grades'] ?? 0 }}</p>
                <a href="{{route('grades.index')}}" class="btn btn-primary">Manage Grades</a>
            </div>
        </div>
    </div>
</body>
</html>