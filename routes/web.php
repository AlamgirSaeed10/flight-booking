<?php

use App\Http\Controllers\DuplicateTicketController;
use App\Http\Controllers\ProfileManagementController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientBookingsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendingController;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


Route::group(['middleware' => ['auth', 'isUser']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
Route::get('/super-admin', [SuperAdminController::class, 'super_admin'])->name('super-admin.dashboard');

Route::get('/single-agent/{AgentID}', [SuperAdminController::class, 'single_agent'])->name('super-admin.agent-detail');

Route::get('/agent-form', [DashboardController::class, 'agent_form'])->name('agent-form');
Route::post('/agent-registration', [DashboardController::class, 'agent_registration'])->name('agent-registration');
Route::get('/agents-details', [DashboardController::class, 'agents_details'])->name('agents-details');
Route::get('invoice/{invoiceNo}', [DashboardController::class, 'invoice'])->name('invoice');

// ===================================
// Client Controller
// ===================================
Route::get('/booking-flight', [ClientBookingsController::class, 'booking_flight'])->name('booking-flight');
Route::get('/issued-tickets', [ClientBookingsController::class, 'issued_tickets'])->name('issued-tickets');
Route::get('/cancelled-booking', [ClientBookingsController::class, 'cancelled_booking'])->name('cancelled-booking');
Route::get('/hold-bookings', [ClientBookingsController::class, 'hold_bookings'])->name('hold-bookings');
Route::get('/search-data', [ClientBookingsController::class, 'search_bookings'])->name('search-data');
Route::post('/booking', [ClientBookingsController::class, 'store_booking'])->name('store_booking');


Route::post('duplicate_invoice', [DuplicateTicketController::class, 'duplicate_ticket'])->name('duplicate-invoice');
Route::get('duplicate-tickets', [DuplicateTicketController::class, 'view_duplicate'])->name('duplicate-ticket');
Route::get('delete_duplicate/{InvoiceNo}', [DuplicateTicketController::class, 'delete_duplicate'])->name('delete_duplicate');
Route::get('/generate-pdf/{InvoiceID}', [DuplicateTicketController::class, 'generatePDF'])->name('generate-pdf');


// ===================================
// Pending Controller
// ===================================
Route::get('/pending-tasks', [PendingController::class, 'pending_tasks'])->name('pending-tasks');
Route::get('/pending-tickets', [PendingController::class, 'pending_tickets'])->name('pending-tickets');
Route::get('/view-tickets/{InvoiceNo}', [PendingController::class, 'view_tickets'])->name('view_tickets');
Route::post('/view-tickets', [PendingController::class, 'update_recipt_detail'])->name('update_recipt_detail');
Route::post('/store_recipt_image', [PendingController::class, 'store_recipt_image'])->name('store_recipt_image');
Route::post('/update_recipt_image', [PendingController::class, 'update_recipt_image'])->name('update_recipt_image');
Route::post('/cancel_ticket', [PendingController::class, 'cancel_ticket'])->name('cancel_ticket');

Route::post('view-ticket', [HomeController::class, 'update'])->name('update');

Route::get('/edit-tickets/{InvoiceNo}', [PendingController::class, 'edit_tickets'])->name('edit-tickets');
Route::post('/update-tickets/{InvoiceNo}', [PendingController::class, 'update_tickets'])->name('update-tickets');


Route::get('profile', [ProfileManagementController::class, 'admin_profile'])->name('admin.profile');
Route::post('update-profile', [ProfileManagementController::class, 'update_profile'])->name('admin.update-profile');
Route::get('agent-profile/{AgentID}', [ProfileManagementController::class, 'view_agent_profile'])->name('admin.agent-profile');
Route::post('block-agent', [ProfileManagementController::class, 'block_agent'])->name('admin.block-agent');
Route::post('update-agent-profile', [ProfileManagementController::class, 'update_agent_profile'])->name('admin.update-agent-profile');
Route::post('delete-agent', [ProfileManagementController::class, 'delete_agent'])->name('admin.delete-agent');


// ===================================
// Reports Controller
// ===================================
Route::get('/reports', [ReportController::class, 'reports'])->name('reports');
Route::post('/view-reports', [ReportController::class, 'supplierReport'])->name('supplierReport');

Route::get('/data', [ReportController::class, 'getReportData'])->name('data');


Route::post('/search', [ReportController::class, 'searchBookingsByDate'])->name('searchBookingsByDate');
Route::post('/search-value', [ReportController::class, 'searchBookingsByValue'])->name('searchBookingsByValue');
