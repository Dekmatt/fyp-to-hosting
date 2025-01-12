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
    }