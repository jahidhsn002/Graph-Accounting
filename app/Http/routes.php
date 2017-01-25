<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'App@Index');
Route::patch('/get', 'App@Get');

//Web
Route::patch('/web/login', 'App@Login');
Route::get('/web/logout', 'App@Logout');

Route::put('/offers', 'AppOffer@Save');
Route::delete('/offers', 'AppOffer@Remove');

Route::put('/chalans', 'AppChalan@Save');
Route::delete('/chalans', 'AppChalan@Remove');

Route::put('/sales', 'AppSale@Save');
Route::delete('/sales', 'AppSale@Remove');

Route::put('/returns', 'AppReturn@Save');
Route::delete('/returns', 'AppReturn@Remove');

Route::put('/invoices', 'AppInvoice@Save');
Route::delete('/invoices', 'AppInvoice@Remove');
Route::patch('/invoices', 'AppInvoice@Payment');
Route::post('/invoices', 'AppInvoice@Offer');

Route::put('/perchases', 'AppPerchase@Save');
Route::delete('/perchases', 'AppPerchase@Remove');
Route::patch('/perchases', 'AppPerchase@Payment');
Route::post('/perchases', 'AppPerchase@Offer');

Route::put('/api/accounts', 'AppAccount@Change');
Route::delete('/api/accounts', 'AppAccount@Remove');

Route::put('/api/products', 'AppProduct@Change');
Route::delete('/api/products', 'AppProduct@Remove');

Route::put('/api/customers', 'AppCustomer@Change');
Route::delete('/api/customers', 'AppCustomer@Remove');

Route::put('/api/suppliers', 'AppSupplier@Change');
Route::delete('/api/suppliers', 'AppSupplier@Remove');



//Accounting Functions
Route::patch('/ac/assets', 'AppAsset@Save');
Route::delete('/ac/assets', 'AppAsset@Remove');

Route::patch('/ac/expenses', 'AppExpense@Save');
Route::delete('/ac/expenses', 'AppExpense@Remove');

Route::patch('/ac/loans', 'AppLoan@Save');
Route::delete('/ac/loans', 'AppLoan@Remove');

Route::patch('/ac/capitals', 'AppCapital@Save');
Route::delete('/ac/capitals', 'AppCapital@Remove');

Route::patch('/ac/drawings', 'AppDrawing@Save');
Route::delete('/ac/drawings', 'AppDrawing@Remove');

//Owner
Route::put('/api/owners', 'AppOwner@Change');
Route::delete('/api/owners', 'AppOwner@Remove');
//Asset Account
Route::put('/api/assetaccounts', 'AppAssetaccount@Change');
Route::delete('/api/assetaccounts', 'AppAssetaccount@Remove');
//Expense Account
Route::put('/api/expenseaccounts', 'AppExpenseaccount@Change');
Route::delete('/api/expenseaccounts', 'AppExpenseaccount@Remove');
//Loan Account
Route::put('/api/loanaccounts', 'AppLoanaccount@Change');
Route::delete('/api/loanaccounts', 'AppLoanaccount@Remove');

//Account
Route::put('/wages', 'AppWage@Save');
Route::patch('/wages', 'AppWage@Payment');
Route::delete('/wages', 'AppWage@Remove');
//Employes
Route::put('/api/employes', 'AppEmploye@Change');
Route::delete('/api/employes', 'AppEmploye@Remove');
//Account
Route::put('/api/users', 'AppUser@Change');
Route::patch('/api/users', 'AppUser@Remove');

//Service
Route::put('/services', 'AppService@Save');
Route::delete('/services', 'AppService@Remove');
Route::patch('/services', 'AppService@Payment');
Route::post('/services', 'AppService@Offer');


