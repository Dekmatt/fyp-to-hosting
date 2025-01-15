<!-- filepath: /c:/laragon/www/spr-fyp/resources/views/admin/roleEdit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Role</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Edit User Role</h2>
        
        <form action="{{ route('admin.updateRole', $user->id) }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="role" class="block text-sm font-bold mb-2">Role</label>
                <select name="role" id="role" class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800 focus:border-gray-500 dark:focus:border-gray-500">
                    <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Save
                </button>
            </div>
        </form>
    </div>
</body>
</html>