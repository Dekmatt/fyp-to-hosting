<!-- filepath: /c:/laragon/www/spr-fyp/resources/views/changepassword.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Change Password</h2>
        
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            
            <div class="mb-4">
                <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control mt-1 block w-full" required>
            </div>
            
            <div class="mb-4">
                <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control mt-1 block w-full" required>
            </div>
            
            <div class="mb-4">
                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control mt-1 block w-full" required>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="custom-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Change Password
                </button>
            </div>
        </form>
    </div>
</body>
</html>