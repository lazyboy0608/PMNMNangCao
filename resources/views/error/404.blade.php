<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>404 - Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        body {
            margin: 0;
            background: linear-gradient(135deg, #1f2933, #ff0000);
            color: #fff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            text-align: center;
            max-width: 500px;
            padding: 40px;
            background: rgba(255,255,255,0.05);
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(0,0,0,.4);
            animation: fadeIn 0.8s ease-in-out;
        }

        h1 {
            font-size: 100px;
            margin: 0;
            color: #ffffff;
        }

        h2 {
            margin: 10px 0;
            font-weight: 600;
        }

        p {
            color: #ffffff;
            margin-bottom: 30px;
        }

        a {
            display: inline-block;
            padding: 12px 28px;
            background: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 500;
            transition: 0.3s;
        }

        a:hover {
            background: #2563eb;
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>404</h1>
    <h2>Page Not Found</h2>
    <p>
        The page you are looking for does not exist or has been moved.
    </p>
    <a href="/">Back to Home</a>
</div>

</body>
</html>
