<!-- filepath: /c:/laragon/www/spr-fyp/resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smartphone Online Repair</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .full-height {
            height: 100vh;
        }
        .flex-center {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: url('{{ asset('images/bground.png') }}') no-repeat center center;
            background-size: cover;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn i {
            margin-right: 8px;
        }
        .button-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 10px;
            margin-top: 250px; /* Move the buttons down */
        }
    </style>
</head>
<body class="flex-center">

    <div class="button-container">
        <a href="{{ route('login') }}" class="btn">
            <i class="fas fa-sign-in-alt"></i> Login
        </a>
        <a href="{{ route('register') }}" class="btn">
            <i class="fas fa-user-plus"></i> Register
        </a>
    </div>
    
</body>
</html>