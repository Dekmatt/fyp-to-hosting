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
            flex-direction: column;
            align-items: center;
            gap: 10px;
            background-color: rgba(255, 255, 255, 0.8); /* Mist color with transparency */
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: absolute;
            right: 40%;
            top: 60%;
            transform: translateY(-50%);
        }
        .description {
            font-size: 18px; /* Increase font size */
            font-weight: bold;
        }
    </style>
</head>
<body class="flex-center">

    <div class="button-container">
        <p class="description">Already Have Account?</p>
        <a href="{{ route('login') }}" class="btn">
            <i class="fas fa-sign-in-alt"></i> Login
        </a>
        <p class="description">Not Registered Yet?</p>
        <a href="{{ route('register') }}" class="btn">
            <i class="fas fa-user-plus"></i> Register
        </a>
    </div>
    
</body>
</html>