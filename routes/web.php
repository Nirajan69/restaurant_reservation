<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\TableController as ControllersTableController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\TableController as ControllersTableController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;


// Route::middleware(['auth'])->group(function () {
//     // This route will point to the index method of CustomerController (the dashboard)
//     Route::get('/customer/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');

//     // Route for the menu
//     Route::get('/customer/menu', [CustomerController::class, 'menu'])->name('customer.menu');
// });


// Routes requiring authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard'); // Dashboard route
    Route::get('/customer/menu', [CustomerController::class, 'menu'])->name('customer.menu'); // Menu route
});



// Route::middleware(['auth'])->group(function () {
//     Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
// });

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/customer/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');


Route::prefix('admin')->name('admin.')->group(function () {

    // Menu Routes
    // Route::resource('menus', MenuController::class);

    // Table Routes
    Route::resource('tables', ControllersTableController::class);
});

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    // Route::get('/dashboard', [AdminMenuController::class, 'index'])->name('dashboard');
    // Route::resource('menus', AdminMenuController::class);
    Route::get('/reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [AdminReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [AdminReservationController::class, 'store'])->name('reservations.store');

});



// Customer menu route
// Route::get('/customer/menu', [MenuController::class, 'index'])->name('customer.menu');


use App\Http\Controllers\Customer\ReservationController;
use App\Http\Controllers\ReservationController as ControllersReservationController;

// Reservation routes for customers
Route::get('/reservation/create', [ReservationController::class, 'create'])->name('reservation.create');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');


// Route to handle reservation form submission
Route::post('/customer/reservation', [ReservationController::class, 'store'])->name('customer.reservation.store');

// Route to show the thank you page after reservation
Route::get('/customer/reservation/thankyou/{id}', [ReservationController::class, 'thankyou'])->name('customer.reservation.thankyou');



use App\Http\Controllers\Customer\FeedbackController;

Route::post('feedback/store', [FeedbackController::class, 'store'])->name('customer.feedback.store');


// Admin Routes (Only accessible by admin)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/menus', [MenuController::class, 'index'])->name('admin.menus.index');
    Route::get('/admin/menus/create', [MenuController::class, 'create'])->name('admin.menus.create');
    Route::post('/admin/menus', [MenuController::class, 'store'])->name('admin.menus.store');
    Route::get('/admin/menus/{id}/edit', [MenuController::class, 'edit'])->name('admin.menus.edit');
    Route::put('/admin/menus/{id}', [MenuController::class, 'update'])->name('admin.menus.update');
    Route::delete('/admin/menus/{id}', [MenuController::class, 'destroy'])->name('admin.menus.destroy');
    Route::resource('menus', App\Http\Controllers\Admin\MenuController::class);
    // Route::put('admin/menus/{id}', [App\Http\Controllers\Admin\MenuController::class, 'update'])->name('admin.menus.update');
    Route::put('admin/menus/{id}', [MenuController::class, 'update'])->name('admin.menus.update');

    //Route::resource('reservations', App\Http\Controllers\Admin\ReservationController::class);
    //Route::resource('reservations', ReservationController::class)->only(['index', 'destroy']);

});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('reservations', App\Http\Controllers\Admin\ReservationController::class)->only(['index', 'destroy']);
});


use App\Http\Controllers\Admin\TableController;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Route to show the edit form
    Route::get('tables/{id}/edit', [TableController::class, 'edit'])->name('admin.tables.edit');

    // Route to handle the update request
    Route::put('tables/{id}', [TableController::class, 'update'])->name('admin.tables.update');
    // Route::get('/menus', [AdminMenuController::class, 'index'])->name('admin.menus.index');
});

// Customer Routes (Anyone can view menus)
// Route::get('/menus', [MenuController::class, 'indexForCustomer'])->name('menus.index');



Route::get('/menu', [CustomerController::class, 'menu'])->name('customer.menu');

Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.home'); // Dashboard route



// Admin routes
// Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::resource('menus', MenuController::class);
// });

// Customer route
Route::get('/menu', [MenuController::class, 'indexForCustomer'])->name('customer.menu');


use App\Http\Controllers\Auth\RegisteredUserController;

// Registration routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register'); // Show registration form
Route::post('/register', [RegisteredUserController::class, 'store']); // Handle registration form submission

Route::get('/reservation/create', [ReservationController::class, 'create']);
Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservation.store');


Route::get('admin/reservations/{id}/edit', [AdminReservationController::class, 'edit'])->name('admin.reservations.edit');
Route::put('admin/reservations/{id}', [AdminReservationController::class, 'update'])->name('admin.reservations.update');

// Route::get('admin/reservations/{id}/edit', [ReservationController::class, 'edit'])->name('admin.reservations.edit');
// Route::get('/reservation/create', [ReservationController::class, 'createReservation']);
// routes/web.php

// Route::get('/reservation/create', [ReservationController::class, 'createReservation']);
// routes/web.php

// Route::get('/reservation/create', [ReservationController::class, 'create']);
// Route::get('/reservation/create', [ReservationController::class, 'create'])->name('reservation.create');

Route::get('/menus', [MenuController::class, 'index']);



Route::get('reservation/step-one', [ReservationController::class, 'stepOne'])->name('customer.reservation.stepOne');
Route::post('reservation/step-one', [ReservationController::class, 'storeStepOne'])->name('customer.reservation.storeStepOne');

// routes/web.php


Route::get('reservation/step-two/{reservationId}', [ReservationController::class, 'stepTwo'])->name('customer.reservation.stepTwo');
Route::post('reservation/step-two/{reservationId}', [ReservationController::class, 'storeStepTwo'])->name('customer.reservation.storeStepTwo');


// Customer Routes
Route::prefix('customer')->name('customer.')->group(function() {
    // Step 1: Show reservation form
    Route::get('/reservation/step-one', [ReservationController::class, 'stepOne'])->name('reservations.step.one');

    // Step 1: Store reservation data
    Route::post('/reservation/step-one', [ReservationController::class, 'storeStepOne'])->name('reservations.store.step.one');

    // Step 2: Show available tables and menus
    Route::get('/reservation/step-two', [ReservationController::class, 'stepTwo'])->name('reservations.step.two');

    // Step 2: Store final reservation details
    Route::post('/reservation/step-two', [ReservationController::class, 'storeStepTwo'])->name('reservations.store.step.two');

    // Thank You page after successful reservation
    Route::get('/reservation/thankyou/{id}', [ReservationController::class, 'thankyou'])->name('reservation.thankyou');
});


// Route::get('/confirmsubmission', [FeedbackController::class, 'confirmSubmission'])->name('confirmsubmission');

// Route::post('/submit-feedback', [FeedbackController::class, 'submitFeedback'])->name('submitFeedback');


Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('customer.feedback.store');
Route::get('/feedback/confirm/{feedback}', [FeedbackController::class, 'confirm'])->name('customer.feedback.confirm');

Route::get('/admin/feedback', [FeedbackController::class, 'index'])->name('admin.feedback.index');
Route::get('/menus', [MenuController::class, 'showMenu'])->name('menus.index');
Route::get('/menus', [MenuController::class, 'showMenu']);

// Route::get('/admin/menus/top-rated', [Admin\MenuController::class, 'showTopRatedMenus'])->name('admin.menus.topRated');
// Admin routes (inside routes/web.php)
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/menus/top-rated', [MenuController::class, 'showTopRatedMenus'])->name('menus.topRated');
});
use App\Http\Controllers\Customer\MenuController as CustomerMenuController;
use App\Http\Controllers\MenuController as ControllersMenuController;

// Route::prefix('customer')->group(function () {
//     Route::get('/menus', [CustomerMenuController::class, 'showTopRatedMenus'])->name('customer.menus.index');
// });


Route::get('/customer/menus', [CustomerMenuController::class, 'showTopRatedMenus'])->name('customer.menus.index');

Route::get('/menu/{id}/recommend', [ControllersMenuController::class, 'recommendSimilarMenus'])->name('menu.recommend');




require __DIR__.'/auth.php';
