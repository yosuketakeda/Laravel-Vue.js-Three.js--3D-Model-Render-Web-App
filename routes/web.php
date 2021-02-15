<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', 'CustomersController@adminIndex');  /// customer admin
Route::get('/admin-register', 'CustomersController@adminRegister')->name('admin.register');  // customer admin

Route::get('/master', 'MasterController@index');
Route::get('/master-admin', 'MasterController@adminIndex');
Route::get('/master-register', 'MasterController@register')->name('master.register');
Route::get('/master-AdminRegister', 'MasterController@adminRegister')->name('master.adminRegister');

Route::get('/reset-password', 'MasterController@resetPassword');
Route::get('/send-mail', 'MailSend@mailsend');

Route::get('/suppliers', 'SuppliersController@index')->name('suppliers.index');
Route::get('/suppliers-admin', 'SuppliersController@adminIndex')->name('suppliers.adminIndex');
Route::get('/suppliers-register', 'SuppliersController@register')->name('suppliers.register');
Route::get('/suppliers-AdminRegister', 'SuppliersController@adminRegister')->name('suppliers.adminRegister');

Route::group(['middleware' => 'auth'], function () {       
    Route::get('/product-customization', 'ProductCustomizationController@index')->name('dashboard');
    Route::get('/contact-form', 'ContactFormController@index')->name('contact_form');
    Route::post('/thanks', 'ThanksController@index')->name('thanks');
    Route::get('/print-pdf', 'ThanksController@printPDF')->name('printPDF');
    Route::get('/order-history', 'OrderHistoryController@index')->name('orderHistory');
    Route::get('/viewOrderStatus', 'OrderHistoryController@viewOrderStatus')->name('viewOrderStatus');
    
    Route::get('/emailContact', 'OrderHistoryController@emailContact')->name('emailContact');
    Route::get('/orderAgain', 'OrderHistoryController@orderAgain')->name('orderAgain');

    // master
    Route::get('/check-user', 'MasterController@checkUser')->name('checkUser'); // redirect after register
    Route::get('/master-dashboard', 'MasterController@adminDashboard')->name('masterDashboard');

    // suppliers
    Route::get('/suppliers-dashboard', 'SuppliersController@suppliersDashboard')->name('suppliersDashboard');

});

// Master post
Route::post('/userCheck', 'MasterController@userCheck')->name('master.userCheck');  
Route::post('/adminIs', 'MasterController@adminIs')->name('admin.is');
Route::post('/adminCheck', 'MasterController@adminCheck')->name('master.adminCheck');
Route::post('/getAdminProductDetails', 'MasterController@getAdminProductDetails')->name('getAdminProductDetails');
Route::post('/getSuppliers', 'MasterController@getSuppliers')->name('getSuppliers');
Route::post('/updateProduct', 'MasterController@updateProduct')->name('updateProduct');
// product creation
Route::post('/uploadProduct', 'MasterController@uploadProduct')->name('uploadProduct');
Route::post('/uploadThumbnail', 'MasterController@uploadThumbnail')->name('uploadThumbnail');
Route::post('/changeThumbnail', 'MasterController@changeThumbnail')->name('changeThumbnail');
Route::post('/saveProduct', 'MasterController@saveProduct')->name('saveProduct');

Route::post('/updateUser', 'MasterController@updateUser')->name('updateUser');
Route::post('/editMasterOrder', 'MasterController@editMasterOrder')->name('editMasterOrder');
Route::post('/orderToSuppliers', 'MasterController@orderToSuppliers')->name('order.to.suppliers');
Route::post('/delOrder', 'MasterController@delOrder')->name('delOrder');

Route::post('/freezeSupplier', 'MasterController@freezeSupplier')->name('freezeSupplier');
Route::post('/delSupplier', 'MasterController@delSupplier')->name('delSupplier');
Route::post('/assignSupplierProducts', 'MasterController@assignSupplierProducts')->name('assignSupplierProducts');
Route::post('/supplierEdit', 'MasterController@supplierEdit')->name('supplierEdit');

Route::post('/freezeCustomer', 'MasterController@freezeCustomer')->name('freezeCustomer');
Route::post('/delCustomer', 'MasterController@delCustomer')->name('delCustomer');
Route::post('/assignCustomerClick', 'MasterController@assignCustomerClick')->name('assignCustomerClick');
Route::post('/assignCustomerProducts', 'MasterController@assignCustomerProducts')->name('assignCustomerProducts');
Route::post('/saveCustomerData', 'MasterController@saveCustomerData')->name('saveCustomerData');
Route::post('/saveCompanyData', 'MasterController@saveCompanyData')->name('saveCompanyData');

Route::post('/changeUserPermission', 'MasterController@changeUserPermission')->name('changeUserPermission');
Route::post('/changeOrderStatus', 'MasterController@changeOrderStatus')->name('changeOrderStatus');

// Customer post
Route::post('/customerCheck', 'CustomersController@userCheck')->name('customer.userCheck');
Route::post('/customerAdminCheck', 'CustomersController@adminCheck')->name('customer.adminCheck');
Route::post('/uploadProductImg', 'ProductCustomizationController@uploadProductImg')->name('uploadProductImg');
Route::post('/emailSend', 'OrderHistoryController@emailSend')->name('emailSend');

// suppliers post
Route::post('/suppliersAdminCheck', 'SuppliersController@adminCheck')->name('suppliers.adminCheck');
Route::post('/suppliersCheck', 'SuppliersController@suppliersCheck')->name('suppliers.check');
Route::post('/suppliersAdminIs', 'SuppliersController@adminIs')->name('suppliers.adminIs');
Route::post('/getSupplierProductDetails', 'SuppliersController@getProductDetails')->name('suppliers.productDetails');
/*
// unused code
Route::post('/orderComplete', 'MasterController@orderComplete')->name('orderComplete');
Route::post('/orderDelete', 'MasterController@orderDelete')->name('orderDelete');
Route::post('/orderRetrieve', 'MasterController@orderRetrieve')->name('orderRetrieve');
*/