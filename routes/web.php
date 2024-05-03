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
//Open Routes
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('signup', [
    'uses' => 'userController@getSignup',
    'as' => 'user.signups',
    ]);

Route::post('signup', [
    'uses' => 'userController@postSignup',
    'as' => 'user.signup',
    ]);
        
Route::get('signin', [
    'uses' => 'userController@getSignin',
    'as' => 'user.signins',
    ]);

Route::post('signin', [
    'uses' => 'LoginController@postSignin',
    'as' => 'user.signin',
    ]);

Route::get('logout',[
  'uses' => 'LoginController@logout',
  'as' => 'user.logout',
  'middleware'=>'auth'  
 ]);

// Route::get('/employees/profile', [
//     'uses' => 'EmployeeController@getProfile',
//     'as' => 'employee.profile',
// ]);

//Grooming Transactions 
Route::get('/groomingtransaction', [
    'uses' => 'GroomingtransactionController@index', 
    'as' => 'groomingtransaction.index',
    ]);

Route::get('add-to-cart/{id}',[
        'uses' => 'GroomingtransactionController@getAddToCart',
        'as' => 'groomingtransaction.addToCart'
    ]);

Route::get('shopping-cart', [
    'uses' => 'GroomingtransactionController@getCart',
    'as' => 'groomingtransaction.shoppingCart'
    ]);

Route::get('remove/{id}',[
        'uses'=>'GroomingtransactionController@getRemoveItem',
        'as' => 'groomingtransaction.remove'
    ]);

//Comment
Route::get('/comment/{id}', [App\Http\Controllers\CommentController::class, 'infos'])->name('groomingtransaction.show');
Route::post('/comment/create', [App\Http\Controllers\CommentController::class, 'create'])->name('comment.create');

//Customer Access
Route::group(['middleware' => 'role:Customer'], function() {
    Route::get('/customers/profile', [
        'uses' => 'CustomerController@getProfile',
        'as' => 'customer.profile',
    ]);
    
    Route::resource('customer','CustomerController');
    Route::get('/pets/create','PetController@create')->name('pets.create');
    Route::get('/pets/edit/{pet}', 'PetController@editss')->name('petss.edit');
    Route::post('/customer/profile','PetController@stores')->name('pets.store');
    Route::PUT('/pets/{pet}/', 'PetController@updates')->name('petss.update');

//Grooming Transaction
    Route::get('checkout',[
        'uses' => 'GroomingtransactionController@postCheckout',
        'as' => 'checkout',
    ]);

    Route::get('/transaction-receipt/', 'GroomingtransactionController@receipt')->name('groomingtransaction.receipt');
});

//-----------------------------------------------------------------------------------
//Employees Access
Route::group(['middleware' => 'role:Admin,Veterinarian,Groomer'], function() {
//Dashboard
Route::get('/home', [
    'uses' => 'DashboardController@index',
    'as' => 'home'
    ]);

Route::post('/home', [
    'uses' => 'DashboardController@search',
    'as' => 'searchhome'
]);

//Employees
Route::get('/employees', [
    'uses' => 'EmployeeController@getEmployees',
    'as' => 'getEmployees'
]);

Route::get('/employees/profile', [
    'uses' => 'EmployeeController@getProfile',
    'as' => 'employee.profile',
  ]);
Route::post('/employee/import', 'EmployeeController@import')->name('employeeImport');
Route::get('/employee/restore/{id}','EmployeeController@restore')->name('employee.restore');
Route::resource('employee','EmployeeController');
Route::post('/employee/import', 'EmployeeController@import')->name('employeeImport');

//Customers
Route::get('/customers', [
    'uses' => 'CustomerController@getCustomers',
     'as' => 'getCustomers'
  ]);
Route::delete('/customer/destroy/{id} ','CustomerController@destroy')->name('customers.destroy');
Route::get('/customer/restore/{id}','CustomerController@restore')->name('customer.restore');
Route::post('/customer/import', 'CustomerController@import')->name('customerImport');

//Grooming
Route::get('/groomings', [
    'uses' => 'GroomingController@getGroomings',
    'as' => 'getGroomings'
  ]);

Route::get('/grooming/restore/{id}','GroomingController@restore')->name('grooming.restore');
Route::resource('grooming','GroomingController');
Route::post('/grooming/import', 'GroomingController@import')->name('groomingImport');

//Checkup
Route::get('/consultation/restore/{id}','ConsultationController@restore')->name('consultation.restore');
Route::resource('consultation','ConsultationController');
Route::get('/search/{search?}',['uses' => 'SearchController@search','as' => 'search'] );

//Pets
Route::get('/pets', [
    'uses' => 'PetController@getPets',
    'as' => 'getPets'
]);
Route::get('/pet/restore/{id}','PetController@restore')->name('pet.restore');
Route::resource('pet','PetController');
Route::post('/pet/import', 'PetController@import')->name('petImport');

//Grooming Transactions -update and search
Route::get('/transaction/transactionlist/', 'GroomingtransactionController@transactions')->name('transaction.transactionlist');
Route::resource('transaction','GroomingtransactionController');
//Route::get('/transactionlist-edit/edit/{id}','GroomingtransactionController@edit')->name('transaction.transactionlist-edit');
Route::get('/update/{id}', [App\Http\Controllers\GroomingtransactionController::class, 'update'])->name('statusUpdate');

//Search
Route::get('/searchs/{search?}',['uses' => 'GroomingtransactionController@search','as' => 'searching'] );
Route::get('/groomingtrans', [
    'uses' => 'GroomingtransactionController@groomings',
    'as' => 'getgroomtrans'
]);
});