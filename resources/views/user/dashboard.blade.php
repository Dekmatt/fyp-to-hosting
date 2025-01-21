<!-- filepath: /c:/laragon/www/spr-fyp/resources/views/user/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
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
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">User Dashboard</h2>
        
        @if (session('status') == 'profile-updated')
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                Profile updated successfully!
            </div>
        @endif


        <!-- Button to navigate to create meeting page -->
        <a href="{{ route('create.meeting') }}" id="startVideoCallButton" class="bg-blue-500 text-white py-2 px-4 rounded mt-4">
            <i class="fas fa-video"></i> Start Video Call
        </a>

        <!-- Button to navigate to edit profile page -->
        <a href="{{ route('profile.edit.customer') }}" id="editProfileButton" class="bg-blue-500 text-white py-2 px-4 rounded mt-4">
            Edit Profile
        </a>

        <!-- Button to log out and navigate to login page -->
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">
                Log Out
            </button>
        </form>
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
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                img.src = 'https://via.placeholder.com/100';
            }
        }
    </script>
</body>
</html>