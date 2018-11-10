<?php
Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::post('/price_tags', 'HomeController@price_tags');
	Route::resource('account','ExpenseaccountController');
	Route::resource('expense','ExpenseController');
	Route::resource('reports','ReportsController');
	Route::post('bank_report','ReportsController@bank_report');
	Route::get('bankreport','ReportsController@bankreport');
	Route::resource('bank','BankController');
	Route::resource('bank_deposite','BankDepositController');
	Route::resource('cheque','ChequeController');
	Route::resource('user','UserController');
	Route::get('cheque_report','ReportsController@cheque_report');
	Route::post('chequereport','ReportsController@chequereport');
	Route::resource('sales','SalesController');
	Route::resource('sales_report','SalesReportController');
	Route::resource('sales_barcodes','BarcodeController');
	Route::resource('category','CategoryController');
	Route::resource('stock','StockController');
	Route::resource('price_tag','PriceTagController');
	Route::resource('work_shifts','WorkShiftController');
	Route::resource('shift_stock','ShiftStockController');
	Route::resource('stock_loss','StockLossController');
});