<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students - School Records System</title>
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
    
        .nav-menu a.active {
            background: #9a8c98;
        }
    
        .nav-menu a.btn-danger {
            background: #c94c4c;
        }
    
        .nav-menu a.btn-danger:hover {
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
            margin-bottom: 20px;
        }
    
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    
        .alert-danger {
            background: #FFFFFF;
            border-left: 4px solid #c94c4c;
            color: #c94c4c;
        }
    
        .alert-success {
            background: #FFFFFF;
            border-left: 4px solid #2e7d32;
            color: #2e7d32;
        }
    
        .card {
            background: #FFFFFF;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
        }
    
        .card h2 {
            font-size: 1.5rem;
            color: #22223b;
            margin: 0 0 15px;
        }
    
        .form-group {
            margin-bottom: 15px;
        }
    
        .form-group label {
            display: block;
            font-size: 0.9rem;
            color: #4a4e69;
            margin-bottom: 5px;
        }
    
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #c9ada7;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
        }
    
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
    
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: background 0.3s ease;
        }
    
        .btn-primary {
            background: #9a8c98;
            color: #f2e9e4;
        }
    
        .btn-primary:hover {
            background: #8a7c88;
        }
    
        .btn-danger {
            background: #c94c4c;
            color: #f2e9e4;
        }
    
        .btn-danger:hover {
            background: #b43c3c;
        }
    
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
    
        .data-table th,
        .data-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #c9ada7;
        }
    
        .data-table th {
            background: #9a8c98;
            color: #f2e9e4;
            font-weight: 600;
        }
    
        .data-table td {
            color: #22223b;
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
    
            .card {
                padding: 15px;
            }
    
            .data-table th,
            .data-table td {
                padding: 8px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>School Records System</h2>
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
        <h1>Manage Students</h1>

       t
        <div class="card">
            <h2>Add New Student</h2>
            <form method="POST" action="{{ route('students.store') }}">
                @csrf
                <input type="hidden" name="action" value="add">
                <div class="form-group">
                    <label for="First_name">First Name</label>
                    <input type="text" id="First_name" name="First_name" value="{{ old('First_name') }}" required>
                    @error('First_name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Last_name">Last Name</label>
                    <input type="text" id="Last_name" name="Last_name" value="{{ old('Last_name') }}" required>
                    @error('Last_name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="" {{ old('gender') ? '' : 'selected' }}>Select Gender</option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                    @error('date_of_birth')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="contact_no">Contact Number</label>
                    <input type="tel" id="contact_no" name="contact_no" value="{{ old('contact_no') }}">
                    @error('contact_no')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address">{{ old('address') }}</textarea>
                    @error('address')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add Student</button>
            </form>
        </div>
                 
    </div>
</body>
</html>
