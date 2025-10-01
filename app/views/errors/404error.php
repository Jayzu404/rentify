<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Internal Server Error</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #ffffff;
            color: #333333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
        }
        
        .error-code {
            font-size: 6rem;
            font-weight: 200;
            color: #666666;
            margin-bottom: 10px;
        }
        
        .error-message {
            font-size: 1.1rem;
            color: #888888;
            font-weight: 300;
            margin-bottom: 30px;
        }
        
        .btn-group {
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        
        .btn {
            padding: 12px 24px;
            color: #ffffff;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 400;
            border-radius: 4px;
            transition: background-color 0.2s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background-color: #333333;
        }
        
        .btn-primary:hover {
            background-color: #555555;
        }
        
        .btn-secondary {
            background-color: #888888;
        }
        
        .btn-secondary:hover {
            background-color: #999999;
        }
    </style>
</head>
<body>
    <div class="error-code">404</div>
    <div class="error-message">Page Not Found</div>
    <div class="btn-group">
        <button class="btn btn-primary" onclick="location.reload()">Try Again</button>
        <a href="/" class="btn btn-secondary">Go Home</a>
    </div>
</body>
</html>