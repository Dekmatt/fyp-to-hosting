<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\User; // Import the User model
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.admindashboard');
    }

    public function showUserTable()
    {
        $users = User::all();
        return view('admin.table', compact('users'));
    }

    public function editRole($id)
    {
        $user = User::findOrFail($id);
        return view('admin.roleEdit', compact('user'));
    }

    public function updateRole(Request $request, $id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if user exists
        if ($user) {
            // Update the role to 'customer'
            $user->role = 'customer';
            $user->save();

            return redirect()->route('admin.users')->with('success', 'User role updated to customer successfully.');
        } else {
            return redirect()->route('admin.users')->with('error', 'User not found.');
        }
    }
}


