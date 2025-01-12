<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Admin Dashboard</h2>
    
    <div class="mt-6">
    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">User List</h3>
    <a href="{{ route('admin.users') }}" class="bg-blue-500 text-white py-2 px-4 rounded inline-block">
        <button class="bg-blue-500 text-white py-2 px-4 rounded">
            Show User Table
        </button>
    </a>
</div>

    <!-- Button to log out and navigate to login page -->
    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">
            Log Out
        </button>
    </form>
</body>
</html>