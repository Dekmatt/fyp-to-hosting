<!-- filepath: /c:/laragon/www/spr-fyp/resources/views/admin/table.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">User Table</h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs font-bold text-black dark:text-white uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs font-bold text-black dark:text-white uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs font-bold text-black dark:text-white uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs font-bold text-black dark:text-white uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs font-bold text-black dark:text-white uppercase tracking-wider">Profile Picture</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs font-bold text-black dark:text-white uppercase tracking-wider">Created At</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs font-bold text-black dark:text-white uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-black dark:text-white">{{ $user->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-black dark:text-white">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-black dark:text-white">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-black dark:text-white">{{ $user->role }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-black dark:text-white">
                <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://via.placeholder.com/50' }}" alt="Profile Picture" class="w-12 h-12 rounded-full"></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-black dark:text-white">{{ $user->created_at }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-black dark:text-white">
                                <a href="{{ route('admin.editRole', $user->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                    Edit Role
                                </a>
                                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this user?')">
                                        Delete User
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>