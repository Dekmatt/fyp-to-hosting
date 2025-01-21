<!-- filepath: /c:/laragon/www/spr-fyp/resources/views/profileeditAdmin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Edit Profile</h2>

        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- filepath: /c:/laragon/www/spr-fyp/resources/views/profileeditAdmin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Edit Profile</h2>

        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('profile.update.admin') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Profile Picture Section -->
            <div class="mb-4">
                <label for="profile_picture" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Profile Picture</label>
                <div class="flex items-center">
                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://via.placeholder.com/100' }}" alt="Profile Picture" class="w-24 h-24 rounded-full mr-4" id="profile-picture-display">
                    <input type="file" name="profile_picture" id="profile_picture" class="form-control mt-1 block w-full" onchange="previewProfilePicture()">
                </div>
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control mt-1 block w-full" required>
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control mt-1 block w-full" required>
            </div>

            <!-- Phone Number Section -->
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="form-control mt-1 block w-full" required>
            </div>

            <!-- Address Section -->
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                <textarea name="address" id="address" class="form-control mt-1 block w-full" required>{{ old('address', $user->address) }}</textarea>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="custom-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Update Profile
                </button>
            </div>
        </form>

        <!-- Button to navigate to change password page -->
        <div class="flex justify-end mt-4">
            <a href="{{ route('password.change') }}" class="custom-button bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                Change Password
            </a>
        </div>
    </div>

    <script>
        function previewProfilePicture() {
            const fileInput = document.getElementById('profile_picture');
            const img = document.getElementById('profile-picture-display');

            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                img.src = reader.result;
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