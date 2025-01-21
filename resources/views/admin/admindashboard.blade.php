<!-- filepath: /c:/laragon/www/spr-fyp/resources/views/admin/admindashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            margin-top: 20px;
        }
        .button-container a, .button-container form {
            display: inline-block;
            margin-right: 10px;
        }
        .profile-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            cursor: pointer;
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
    </style>
</head>
<body>
    <div class="header">
        <h2>Admin Dashboard</h2>
    </div>
    <div class="container">
        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Greeting Section -->
        <div class="mb-4">
            <h3>Hi, {{ auth()->user()->name }}!</h3>
        </div>
        
        <form id="profile-picture-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="file" name="profile_picture" id="profile_picture" class="hidden" onchange="previewAndSubmit()">
        </form>

        <!-- User List Section -->
        <div class="mt-6">
            <a href="{{ route('admin.users') }}" class="bg-blue-500 text-white py-2 px-4 rounded inline-block button">
                <i class="fas fa-table"></i> Show User Table
            </a>
        </div>

        <!-- Buttons -->
        <div class="button-container">
            <a href="/agoraVideo/index.html" id="startVideoCallButton" class="bg-blue-500 text-white py-2 px-4 rounded inline-block button">
                <i class="fas fa-users"></i> Gathering Meet
            </a>

            <a href="{{ route('profile.edit.admin') }}" id="editProfileButton" class="bg-blue-500 text-white py-2 px-4 rounded inline-block button">
                <i class="fas fa-user-edit"></i> Edit Profile
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded button">
                    <i class="fas fa-sign-out-alt"></i> Log Out
                </button>
            </form>
        </div>
    </div>

    <script>
        function previewAndSubmit() {
            const fileInput = document.getElementById('profile_picture');
            const form = document.getElementById('profile-picture-form');
            const img = document.getElementById('profile-picture-display');

            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                img.src = reader.result;
                form.submit();
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                img.src = 'https://via.placeholder.com/100';
            }
        }
    </script>
</body>
</html>