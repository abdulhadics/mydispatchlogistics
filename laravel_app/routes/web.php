<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CarrierController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); // Or redirect to login
})->name('home');

Route::view('/services', 'services')->name('services');
Route::view('/pricing', 'pricing')->name('pricing');
Route::view('/fleet', 'fleet')->name('fleet');
use App\Http\Controllers\TrackingController;

// ...

Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking');
Route::post('/tracking', [TrackingController::class, 'track'])->name('tracking.track');

use App\Http\Controllers\DocumentsController;
Route::get('/documents/{type}', [DocumentsController::class, 'view'])->name('documents.view');

use App\Http\Controllers\BlogController;
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::view('/about', 'about')->name('about');

// Carrier Setup Routes
Route::get('/carrier-setup', [CarrierController::class, 'index'])->name('carrier-setup');
Route::post('/carrier-setup', [CarrierController::class, 'store'])->name('carrier-setup.store');

// Contact Routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resources
    Route::resource('loads', LoadController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('messages', MessageController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('users', UserController::class);

    // Notifications
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/unread', [App\Http\Controllers\NotificationController::class, 'getUnread'])->name('notifications.unread');
    Route::post('/notifications/{notification}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Admin Routes
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/admin/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('admin.categories');
    Route::post('/admin/categories', [App\Http\Controllers\CategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('/admin/categories/{category}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::get('/admin/rules', [App\Http\Controllers\RuleController::class, 'index'])->name('admin.rules');
    Route::post('/admin/rules', [App\Http\Controllers\RuleController::class, 'store'])->name('admin.rules.store');
    Route::delete('/admin/rules/{rule}', [App\Http\Controllers\RuleController::class, 'destroy'])->name('admin.rules.destroy');
});
