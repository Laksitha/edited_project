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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/dashboard', function () {
    $data = App\Employee::all();

    return view('/admin/dashboard')->with('Emp', $data);
});
//Route::get('/admin/dashboard','AdminController@dashboard');

//Route::get('/admin','AdminController@login');
Route::match(['get', 'post'], 'admin', 'AdminController@login');

Route::get('/admin/add_newEmp', 'AdminController@add_newEmp');

Route::get('/admin/report', 'AdminController@report');

// routes for the pass values to database from adnewemp....
Route::get('/admin/add_newEmp', 'EmployeeController@index');
Route::post('/admin/add_newEmp', 'EmployeeController@store');
//end of adnewemp

Route::get('/admin/payroll/{emp_id?}', 'AdminController@payroll')->name('payroll');

Route::get('/admin/report/','AdminController@report')->name('admin-reports');

//slary slip
Route::get('/admin/report/salarySlip/{id}/{month}/{year}','AdminController@salarySlip')->name('admin-salaryslip');
//epfReport
Route::get('/admin/report/epfReport/{month}/{year}','AdminController@epfReport')->name('admin-epfreport');
Route::get('/admin/report/etfReport/{month}/{year}','AdminController@etfReport')->name('admin-etfreport');
/*Route::group(['middleware'=>['auth']],function(){
});*/
Route::post('/admin/payroll','PayrollController@store');

Route::resource('edit', 'EditController');
Route::get('/logout', 'AdminController@logout');
