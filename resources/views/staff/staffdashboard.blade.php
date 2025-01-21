<!-- filepath: /c:/laragon/www/spr-fyp/resources/views/staff/staffdashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .custom-button {
            background-color: #1D4ED8; /* Blue color */
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-align: center;
            display: inline-block;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .custom-button:hover {
            background-color: #2563EB; /* Darker blue on hover */
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Staff Dashboard</h2>

        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Button to navigate to gathering meet page -->
        <a href="/agoraVideo/index.html" id="startVideoCallButton" class="custom-button mt-4">
            Gathering Meet
        </a>

        <!-- Button to navigate to create meeting page -->
        <a href="{{ route('create.meeting') }}" id="startVideoCallButton" class="custom-button mt-4">
            Start Video Call
        </a>

        <!-- Button to navigate to edit profile page -->
        <a href="{{ route('profile.edit.staff') }}" id="editProfileButton" class="custom-button mt-4">
            Edit Profile
        </a

        <!-- Button to log out and navigate to login page -->
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="custom-button bg-red-500 hover:bg-red-700">
                Log Out
            </button>
        </form>
    </div>
</body>
</html>