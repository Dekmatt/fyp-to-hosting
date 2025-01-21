<!-- filepath: /c:/laragon/www/spr-fyp/resources/views/admin/detail.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">User Details</h2>
        
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $user->email }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $user->phone }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $user->address }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Created At</label>
                <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $user->created_at }}</p>
            </div>
        </div>
    </div>
</body>
</html>