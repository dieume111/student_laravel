<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Login</title>
    <style>
        /* Base Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', system-ui, sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Card Container */
        .login-card {
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 400px;
        }

        /* Typography */
        .login-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #333;
        }

        /* Form Elements */
        .input-group {
            margin-bottom: 1.5rem;
        }

        .input-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #555;
        }

        .input-field {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
        }

        .input-field:focus {
            outline: none;
            border-color: #888;
        }

        /* Button */
        .login-button {
            width: 100%;
            padding: 0.75rem;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .login-button:hover {
            background-color: #222;
        }

        /* Footer Link */
        .footer-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }

        .footer-link a {
            color: #333;
            font-weight: 500;
            text-decoration: none;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h1 class="login-title">System Login</h1>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <label for="user_name" class="input-label">Username</label>
                <input type="text" id="user_name" name="user_name" class="input-field" required>
            </div>
            
            <div class="input-group">
                <label for="password" class="input-label">Password</label>
                <input type="password" id="password" name="password" class="input-field" required>
            </div>
            
            <button type="submit" class="login-button">
                Sign In
            </button>
        </form>
        
        <p class="footer-link">
            Don't have an account? <a href="{{ route('register') }}">Register</a>
        </p>
    </div>
</body>
</html>