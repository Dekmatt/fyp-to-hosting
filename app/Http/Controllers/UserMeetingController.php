<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeetingController extends Controller
{
    /**
     * Show the form for creating a new meeting.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('createMeetinguser'); // Ensure this view exists
    }
}