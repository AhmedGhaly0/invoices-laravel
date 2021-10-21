<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ArchivesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Auth;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('auth.login');});



Auth::routes();



// User
// Route::get('user/all-user', [UserController::class,"index"]);
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::post('changePassword', [UserController::class,'updatePassword'])->name('update.Password');
    Route::get('edit-user/{id}', [UserController::class,'editUserAuth'])->name('user.editauth');
    Route::post('updateUserAuth', [UserController::class,'updateUserAuth'])->name('update.updateUserAuth');



});





Route::get('/home', [HomeController::class, 'index'])->name('home');



// InvoicesController
Route::get('invoices', [InvoicesController::class,'index']);
Route::get('invoices/create-invoices', [InvoicesController::class,'create']);
Route::get('invoices/paid', [InvoicesController::class,'paid']);
Route::get('invoices/unpaid', [InvoicesController::class,'unpaid']);
Route::get('invoices/Partial', [InvoicesController::class,'Partial']);
Route::get('invoices/{id}', [InvoicesController::class,'getproducts']);
Route::post('invoices/addinvoices', [InvoicesController::class,'store'])->name('invoices.store');
Route::post('invoices/updateinvoice', [InvoicesController::class,'update'])->name('invoice.update');
Route::post('invoices/delete-invoice', [InvoicesController::class,'destroy'])->name('invoice.delete');
Route::get('invoices/edit-invoice/{id}', [InvoicesController::class,'edit']);
Route::get('invoices/status_show/{id}', [InvoicesController::class,'show']);
Route::post('invoices/status-update', [InvoicesController::class,'status_update'])->name('status.update');
Route::get('invoices/Print-invoice/{id}', [InvoicesController::class,'Print_invoice']);
Route::get('Invoices/export-invoice', [InvoicesController::class,"export"]);
Route::post('raedAt_All', [InvoicesController::class,"raedAt_All"])->name('Raed_At.All');
Route::post('deleteNotification', [InvoicesController::class,"deleteNotification"])->name('delete.notification');
Route::post('read_notify', [InvoicesController::class,"read_notify"]) -> name('read.one.notify');






// ArchivesController
Route::get('archives', [ArchivesController::class,'index']);
Route::post('invoices/restor', [ArchivesController::class,'restore'])->name('invoice.restor');
Route::post('invoices/destroy', [ArchivesController::class,'destroy'])->name('invoice.destroy');









//InvoicesDetailsController
Route::get('invoices/invoices-details/{id}', [InvoicesDetailsController::class,'edit']);
Route::get('invoices/invoices-details/view-file/{number}/{name}', [InvoicesDetailsController::class,'viewFile']);
Route::get('invoices/invoices-details/download/{number}/{name}', [InvoicesDetailsController::class,'download']);

Route::post('invoices/delete-file', [InvoicesDetailsController::class,'destroy'])->name('delete.file');
Route::post('invoices/add-file', [InvoicesDetailsController::class,'store'])->name('add.file');





// SectionController
Route::get('section', [SectionController::class,'index']);
Route::post("/section/addsection", [SectionController::class,'store'])->name('add.section');
Route::post("/section/updatesection", [SectionController::class,'update'])->name('update.section');
Route::post("/section/delete", [SectionController::class,'delete']);
// Route::resource('section', 'SectionController');

// ProductsController
Route::get('products', [ProductsController::class,'index'])->middleware('auth');
Route::post('products/addproduct', [ProductsController::class,'store'])->name('add.product');
Route::post('products/update-product', [ProductsController::class,'update'])->name('update.product');
Route::post('products/delete', [ProductsController::class,'destroy']);

// ReportsController
Route::get('invoices-report',[ReportsController::class,'index']);
Route::post('invoices-report',[ReportsController::class,'search'])->name('Search_invoices');

Route::get('customers-report',[ReportsController::class,'CustomerShow']);
Route::post('customers-report',[ReportsController::class,'CustomerSearch'])->name('Search_customers');


// difult
Route::get('/{page}', [AdminController::class,'index']);
