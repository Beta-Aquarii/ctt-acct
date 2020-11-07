<?php

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

Route::get('/', function () {
    return view('index');
});
Route::group(['middleware' => ['admin']], function () {
	Route::get('/univ/tour-fs', 'FilterController@getFilterSearch');
});
Route::group(['middleware' => ['admin']], function () {
	Route::prefix('admin')->group(function () {
		Route::get('/', 'AdminController@index');

		Route::get('add/user', 'AdminController@getAddUser');
		Route::post('add/user','AdminController@postAddUser');

		Route::get('add/tour', 'AdminController@getAddTour');
		Route::post('add/tour', 'AdminController@postAddTour');
		Route::get('edit/tour/{id}', 'AdminController@getEditTour');
		Route::post('edit/tour/{id}','AdminController@postEditTour');

		Route::get('add/agent', 'AdminController@getAddAgent');
		Route::post('add/agent', 'AdminController@postAddAgent');
		Route::get('edit/agent/{id}', 'AdminController@getEditAgent');
		Route::post('edit/agent/{id}', 'AdminController@postEditAgent');

		Route::post('delete', 'AdminController@delete');
		Route::post('deleteconorpeak', 'AdminController@deleteconorpeak');
		Route::get('tours','AdminController@getTours');
		Route::get('users','AdminController@getUsers');
		Route::get('agents','AdminController@getAgents');
		Route::get('tour-fs', 'AdminController@getFilterSearch');
	});
});

Route::group(['middleware' => ['reservation']], function () {
	Route::prefix('reservation')->group(function () {
		Route::get('/', 'ReservationController@index');
		Route::get('tours','ReservationController@getTours');
		Route::get('agents','ReservationController@getAgents');
		Route::get('salesinvoice','ReservationController@getSalesInvoice');
		Route::get('add/salesinvoice','ReservationController@getAddSalesInvoice');
		Route::post('add/salesinvoice','ReservationController@postAddSalesInvoice');
		Route::get('edit/salesinvoice/{id}','ReservationController@getEditSalesInvoice');
		Route::post('edit/salesinvoice/{id}','ReservationController@postEditSalesInvoice');
		Route::get('tour-fs', 'AdminController@getFilterSearch');
		Route::get('si-agent-search', 'ReservationController@getSiAgentSearch');
		Route::get('si-particular-search', 'ReservationController@getSiParticularSearch');
		Route::get('si-agent-add', 'ReservationController@getSiAgentAdd');
		Route::get('si-particular-add', 'ReservationController@getSiParticularAdd');
		Route::get('si-particular-calc', 'ReservationController@getSiParticularCalc');
		Route::get('si-search', 'ReservationController@getSiSearch');
		Route::get('si-filter-row', 'ReservationController@getFilterSiRow');
		Route::get('remove/particular-edit', 'ReservationController@deleteParticularEdit');
		Route::get('view/particular/{id}', 'ReservationController@getViewParticular');
		Route::get('view/agent/{id}', 'ReservationController@getViewAgent');
	});
});

Route::group(['middleware' => ['accounting']], function () {
	Route::prefix('accounting')->group(function () {
		Route::get('/', 'AccountingController@index');
		Route::get('statement-of-account','AccountingController@getSalesInvoice');
		Route::get('statement-of-account/verified','AccountingController@getSalesInvoiceVerified');
		Route::get('statement-of-account/table','AccountingController@getSalesInvoiceTable');
		Route::get('statement-of-account/table/verified','AccountingController@getSalesInvoiceTableVerified');
		Route::get('sales-report','AccountingController@getSalesReport');
		Route::post('verify','AccountingController@getVerifySoa');
		Route::get('check-soa/{id}','AccountingController@getCheckSi');
		Route::post('check-soa/{id}','AccountingController@postCheckSi');
		Route::get('tours','AccountingController@getTours');
		Route::get('agents','AccountingController@getAgents');
		Route::get('tour-fs', 'AdminController@getFilterSearch');
		Route::get('view/particular/{id}', 'AccountingController@getViewParticular');
		Route::get('view/agent/{id}', 'AccountingController@getViewAgent');
		Route::get('si-search', 'AccountingController@getSiSearch');
		Route::get('si-search-table', 'AccountingController@getSiSearchTable');
		Route::get('si-filter-row', 'AccountingController@getFilterSiRow');
		Route::get('si-filter-table-row', 'AccountingController@getFilterSiTableRow');
		Route::get('sr-get-date', 'AccountingController@getSalesReportDate');
		Route::get('print/{id}','AccountingController@getPrint');
		Route::get('print-sales-report/{start}/{end}','AccountingController@getPrintSalesReport');
	});
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
