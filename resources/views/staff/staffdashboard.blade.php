<!-- filepath: /c:/laragon/www/spr-fyp/resources/views/staff/staffdashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgb(165, 53, 53);
            position: relative;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .mt-6 {
            margin-top: 20px;
        }
        h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .bg-blue-500 {
            background-color: #007bff;
        }
        .bg-red-500 {
            background-color: #dc3545;
        }
        .text-white {
            color: #fff;
        }
        .py-2 {
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .px-4 {
            padding-left: 20px;
            padding-right: 20px;
        }
        .rounded {
            border-radius: 5px;
        }
        .inline-block {
            display: inline-block;
        }
        .button-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
            margin-top: 20px;
        }
        .button-box {
            background-color: #999; /* Dark grey color */
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgb(102, 94, 94);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80px; /* Adjust the height as needed */
        }
        .profile-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            cursor: pointer;
            position: relative;
        }
        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
        }
        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .hidden {
            display: none;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 5px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
        .button i {
            margin-right: 8px;
        }
        .logout-button-container {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Staff Dashboard</h2>
    </div>
    <div class="container">
        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Profile Picture Section -->
        <div class="profile-container">
            <div class="profile-picture">
                <img id="profile-picture-display" src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : 'https://via.placeholder.com/100' }}" alt="Profile Picture">
            </div>
            <!-- Greeting Section -->
            <div class="mb-4">
                <h3>Hi, {{ auth()->user()->name }}!</h3>
            </div>
            <!-- Logout Button -->
            <div class="logout-button-container">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded button">
                        <i class="fas fa-sign-out-alt"></i> Log Out
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Buttons -->
        <div class="button-container">
            <div class="button-box">
                <a href="/agoraVideo/index.html" id="startVideoCallButton" class="bg-blue-500 text-white py-2 px-4 rounded inline-block button">
                    <i class="fas fa-users"></i> Gathering Meet
                </a>
            </div>
            <div class="button-box">
                <a href="{{ route('create.meeting') }}" id="startVideoCallButton" class="bg-blue-500 text-white py-2 px-4 rounded inline-block button">
                    <i class="fas fa-video"></i> Start Video Call
                </a>
            </div>
            <div class="button-box">
                <a href="{{ route('profile.edit.staff') }}" id="editProfileButton" class="bg-blue-500 text-white py-2 px-4 rounded inline-block button">
                    <i class="fas fa-user-edit"></i> Edit Profile
                </a>
            </div>
        </div>
    </div>
</body>
</html>