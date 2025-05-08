<div class="header">
    <h2>Class Attendance System</h2>
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
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<div class="container">
    <h1>Student Information</h1>
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <form method="POST" action="" class="attendance-form">
            @csrf
            <table class="data-entry-table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{$student->student_id}}</td>
                        <td>{{$student->First_name}}</td>
                        <td>{{$student->Lat_name}}</td>
                        <td>{{$student->gender}}</td>
                        <td>{{$student->contact_no}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{$student->address}}</td>
                        <td>{{$student->date_of_birth}}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

<style>
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
    
    .btn-info {
        background: #9a8c98;
    }
    
    .btn-danger {
        background: #c94c4c;
    }
    
    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
    }
    
    .data-entry-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    .data-entry-table th, 
    .data-entry-table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }
    
    .data-entry-table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }
    
    .data-entry-table input[type="text"],
    .data-entry-table input[type="email"],
    .data-entry-table input[type="tel"],
    .data-entry-table input[type="date"],
    .data-entry-table select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
    
    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
    
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
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
        
        .data-entry-table {
            display: block;
            overflow-x: auto;
        }
    }
</style>