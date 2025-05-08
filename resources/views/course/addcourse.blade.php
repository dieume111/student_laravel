<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add course</title>
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

        .header h1 {
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

        .nav-menu a.active {
            background-color: #3498db;
        }

        .btn-danger {
            background-color: #e74c3c;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .container h2 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2c3e50;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52,152,219,0.3);
        }

        .text-red-600 {
            color: #e74c3c;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .alert-danger {
            background-color: #fde8e8;
            color: #e74c3c;
            border: 1px solid #fbd5d5;
        }

        .alert-success {
            background-color: #e8f8e8;
            color: #27ae60;
            border: 1px solid #d5f5d5;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>class courses system</h1>

        <div class="nav-menu">
            <a href="{{ route('dashboard') }}">Back to Dashboard</a>
            <a href="{{ route('students.index') }}" class="active">Students</a>
            <a href="{{ route('logout') }}" class="btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <div class="container">
        <h2>Manage classes courses</h2>
        @if (isset($error) && $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endif

    @if (isset($success) && $success)
        <div class="alert alert-success">{{ $success }}</div>
    @endif

    <form action="{{route('courses.store')}}" method="POST">
    @csrf
        <div class="form-group">
        <label for="coursename">Course Name</label>
        <input type="text" id="coursename" name="course_name" value="{{ old('course_name') }}" required>
        @error('course_name')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="coursename">Description</label>
        <input type="text" id="description" name="description" value="{{ old('description') }}" required>
        @error('description')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="coursename">Duration</label>
        <input type="text" id="coursename" name="duration" value="{{ old('duration')}}" required>
        @error('duration')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
        </div>
          <button type="submit" class="btn btn-primary">Add the course</button>
    </div>
</form>
</body>
</html>