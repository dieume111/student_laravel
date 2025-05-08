<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Courses</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            line-height: 1.6;
        }

        .header {
            background-color: #2c3e50;
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .header h2 {
            margin-bottom: 1rem;
            font-size: 1.8rem;
        }

        .nav-menu {
            display: flex;
            gap: 1rem;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .nav-menu a:hover {
            background-color: #34495e;
        }

        .btn-danger {
            background-color: #e74c3c;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .btn-info {
            background-color: #3498db;
        }

        .btn-info:hover {
            background-color: #2980b9;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .data-entry-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            background-color: white;
        }

        .data-entry-table thead tr {
            background-color: #2c3e50;
            color: white;
        }

        .data-entry-table th,
        .data-entry-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .data-entry-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .data-entry-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        @media (max-width: 768px) {
            .data-entry-table {
                display: block;
                overflow-x: auto;
            }
            
            .container {
                margin: 1rem;
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Courses Timetable</h2>
        <div class="nav-menu">
            <a href="{{ route('dashboard') }}" class="btn-info">Back to Home</a>
            <a href="{{ route('logout') }}" class="btn-danger" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <div class="container">
        <table class="data-entry-table">
            <thead>
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Description</th>
                    <th>Duration</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>{{$course->course_id}}</td>
                    <td>{{$course->course_name}}</td>
                    <td>{{$course->description}}</td>
                    <td>{{$course->duration}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>




