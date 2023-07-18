<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientBookingsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendingController;

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
    return view('auth.login');
});


Auth::routes();

// ===================================
// Home Controller
// ===================================
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/agent-form', [DashboardController::class, 'agent_form'])->name('agent-form');
Route::post('/agent-registration', [DashboardController::class, 'agent_registration'])->name('agent-registration');
Route::get('/agents-details', [DashboardController::class, 'agents_details'])->name('agents-details');
Route::get('invoice/{invoiceNo}', [DashboardController::class, 'invoice'])->name('invoice');




// ===================================
// Client Controller
// ===================================
Route::get('/booking-flight',[ClientBookingsController::class,'booking_flight'])->name('booking-flight');
Route::get('/issued-tickets',[ClientBookingsController::class,'issued_tickets'])->name('issued-tickets');
Route::get('/cancelled-booking',[ClientBookingsController::class,'cancelled_booking'])->name('cancelled-booking');
Route::get('/hold-bookings',[ClientBookingsController::class,'hold_bookings'])->name('hold-bookings');
Route::get('/search-data',[ClientBookingsController::class,'search_bookings'])->name('search-data');
Route::post('/booking', [ClientBookingsController::class, 'store_booking'])->name('store_booking');
Route::post('/search', [ClientBookingsController::class, 'search'])->name('search');



// ===================================
// Pending Controller
// ===================================
Route::get('/pending-tasks',[PendingController::class,'pending_tasks'])->name('pending-tasks');
Route::get('/pending-tickets',[PendingController::class,'pending_tickets'])->name('pending-tickets');
Route::get('/view-tickets/{InvoiceNo}',[PendingController::class,'view_tickets'])->name('view_tickets');
Route::post('/view-tickets',[PendingController::class,'update_recipt_detail'])->name('update_recipt_detail');
Route::post('/store_recipt_image',[PendingController::class,'store_recipt_image'])->name('store_recipt_image');
Route::post('/update_recipt_image',[PendingController::class,'update_recipt_image'])->name('update_recipt_image');
Route::post('/cancel_ticket',[PendingController::class,'cancel_ticket'])->name('cancel_ticket');

Route::get('view-tivket',[HomeController::class,'update'])->name('update');

Route::get('/edit-tickets/{InvoiceNo}',[PendingController::class,'edit_tickets'])->name('edit-tickets');
Route::post('/update-tickets/{InvoiceNo}',[PendingController::class,'update_tickets'])->name('update-tickets');







// ===================================
// Reports Controller
// ===================================
Route::get('/reports', [ReportController::class, 'reports'])->name('reports');
Route::get('/data', [ReportController::class, 'getReportData'])->name('data');
