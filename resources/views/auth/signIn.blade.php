<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 36px;
            font-weight: 700;
        }
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }
        
        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 10px;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .link-login {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
        
        .link-login a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        
        .link-login a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div>
        <h1>Sign In</h1>
        
        <form action="/auth/checkSignIn" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="username">User Name:</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="{{ old('password') }}" required>
            </div>
            
            <div class="form-group">
                <label for="cfpassword">Confirm Password:</label>
                <input type="password" id="cfpassword" name="cfpassword" required>
            </div>
            
            <div class="form-group">
                <label for="mssv">MSSV:</label>
                <input type="text" id="mssv" name="mssv" value="{{ old('mssv') }}" required>
            </div>
            <div class="form-group">
                <label for="class">Class</label>
                <input type="text" id="class" name="class" value="{{ old('class') }}" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <input type="text" id="gender" name="gender" value="{{ old('gender') }}" required>
            </div>
            <button type="submit" class="btn">Sign In</button>
        </form>
        
        <div class="link-login">
            Already have an account? <a href="/login">Login here</a>
        </div>
    </div>
</body>
</html>
