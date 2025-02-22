<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController\UserController;
use App\Http\Controllers\StaffController\StaffController;
use App\Http\Controllers\AdminController\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;



// Web Routes
Route::get('/', function () {
    return view('welcome');
});

// Route for registration
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');


//FOR CUSTOMER USE
// Route for customer dashboard
Route::get('/dashboard', [UserController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route for profile edit and update
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/profile/edit/customer', [ProfileController::class, 'editCustomer'])->name('profile.edit.customer');
    Route::put('/profile/update/customer', [ProfileController::class, 'updateCustomer'])->name('profile.update.customer');
});

Route::get('/feedback', function () {
    return view('user.feedback');
})->name('feedback');

// Add this route for the create meeting page
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/meeting/create/user', [MeetingController::class, 'createMeetingUser'])->name('create.meeting.user');
    Route::get('/joinMeeting/{url}', [MeetingController::class, 'joinMeeting'])->name('joinMeeting');
    Route::get('/createMeeting', [MeetingController::class, 'createMeeting'])->name('createMeeting');
    Route::get('/saveUserName', [MeetingController::class, 'saveUserName'])->name('saveUserName');
        Route::get('/saveUserName', [MeetingController::class, 'saveUserName'])->name('saveUserName');
});


Route::post('/saveUserName', [MeetingController::class, 'saveUserName'])->name('saveUserName');
Route::get('/feedback', function () {
    return view('user.feedback');
})->name('feedback');
Route::post('/feedback', [FeedbackController::class, 'submit'])->name('feedback.submit');






//FOR STAFF USE
// Route for staff dashboard
Route::get('/staff-dashboard', [StaffController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('staff.dashboard');

// Route for profile edit and update
    Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('/profile/edit/staff', [ProfileController::class, 'editStaff'])->name('profile.edit.staff');
    Route::put('/profile/update/staff', [ProfileController::class, 'updateStaff'])->name('profile.update.staff');
    Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');
});



// Add this route for the create meeting page
Route::get('/create-meeting', [MeetingController::class, 'meetingUser'])->name('create.meeting');
Route::get('/joinMeeting/{url}', [MeetingController::class, 'joinMeeting'])->name('joinMeeting');
Route::get('/createMeeting', [MeetingController::class, 'createMeeting'])->name('createMeeting');
Route::get('/saveUserName', [MeetingController::class, 'saveUserName'])->name('saveUserName');
Route::post('/meetingApprove', [MeetingController::class, 'meetingApprove'])->name('meetingApprove');















//FOR ADMIN USE
// Route for admin dashboard
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

Route::get('/admin/users', [AdminController::class, 'showUserTable'])
    ->middleware(['auth', 'verified'])
    ->name('admin.users');

Route::get('/admin/users/{id}/edit', [AdminController::class, 'editRole'])
    ->middleware(['auth', 'verified'])
    ->name('admin.editRole');

Route::put('/admin/users/{id}', [AdminController::class, 'updateRole'])
    ->middleware(['auth', 'verified'])
    ->name('admin.updateRole');

    Route::get('/admin/user/{id}/edit', [AdminController::class, 'editRole'])->name('admin.editRole');
Route::put('/admin/user/{id}/update', [AdminController::class, 'updateRole'])->name('admin.updateRole');
Route::get('/admin/user/{id}/details', [AdminController::class, 'userDetails'])->name('admin.userDetails');

Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])
    ->middleware(['auth', 'verified'])
    ->name('admin.deleteUser');

// Route for profile edit and update
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/profile/edit/admin', [ProfileController::class, 'editAdmin'])->name('profile.edit.admin');
    Route::put('/profile/update/admin', [ProfileController::class, 'updateAdmin'])->name('profile.update.admin');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::get('/feedback', function () {
    return view('user.feedback');
})->name('feedback');
Route::post('/feedback', [FeedbackController::class, 'submit'])->name('feedback.submit');


// Group for authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

// Require additional authentication routes
require __DIR__.'/auth.php';

// Prevent login and logout to back navigation
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');



// Add routes for 2FA setup and verification
Route::middleware('auth')->group(function () {
    // Show the 2FA setup page with the QR code
    Route::get('/2fa', [TwoFactorController::class, 'show'])->name('2fa.show');
    
    // Handle the 2FA code submission
    Route::post('/2fa', [TwoFactorController::class, 'store'])->name('2fa.store');
});

Route::get('twofactor', [LoginController::class, 'showTwoFactorForm'])->name('auth.twofactor');
Route::post('verify-2fa', [LoginController::class, 'verify2fa'])->name('auth.verify2fa');
Route::post('/2fa/verify', [App\Http\Controllers\Auth\TwoFactorController::class, 'verify'])->name('2fa.verify');

Route::get('/password/change', [PasswordController::class, 'edit'])->name('password.change');
Route::post('/password/change', [PasswordController::class, 'update'])->name('password.update');
Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');