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

Route::get('/companies', 'CompaniesController@index');

Route::get('/companies/{id}', 'CompaniesController@show')->name('companies.show');

Route::get("artisan-test", function(){
    $artisan = Artisan::call('dealroom:import', ['max' => 20]);
});
