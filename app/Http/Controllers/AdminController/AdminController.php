<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\User; // Import the User model
use Illuminate\Http\Request;
use App\Models\Feedback;

class AdminController extends Controller
{
    public function dashboard()
    {
        $feedbacks = Feedback::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.admindashboard', compact('feedbacks'));
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
        $user = User::findOrFail($id);
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('admin.editRole', $user->id)->with('success', 'Role updated successfully.');
    }
    

    public function userDetails($id)
    {
        $user = User::findOrFail($id);
        return view('admin.detail', compact('user'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }
}


