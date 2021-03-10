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

Route::get('/', function () {
    return view('welcome');
})->middleware(['guest:web', 'guest:admin', 'guest:officer']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => '/'], function() {
   Route::resource('crime', 'CrimeResource');
   Route::resource('item', 'LostResource');
   Route::get('items/all', 'LostResource@allReported')->name('items.allReported');
   Route::get('/item/state/{item}', 'LostResource@changeCollected')->name('item.state');
});

Route::group(['prefix' => 'admin'], function() {
   Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
   Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
   Route::post('/logout', 'AdminController@logout')->name('admin.logout');
   Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
   Route::resource('/police', 'PoliceResource');
   Route::get('/profile/{admin}', 'AdminController@editProfile')->name('admin.profile');
   Route::put('/profile/{admin}', 'AdminController@updateProfile')->name('admin.profile.update');
});

Route::group(['prefix' => 'police'], function(){
   Route::get('/login', 'Auth\PoliceLoginController@showLoginForm')->name('police.login');
   Route::post('/login', 'Auth\PoliceLoginController@login')->name('police.login.submit');
   Route::post('/logout', 'PoliceController@logout')->name('police.logout');
   Route::get('/dashboard', 'PoliceController@index')->name('police.dashboard');
   Route::group(['prefix'=>'crimes'], function (){
      Route::get('/', 'PoliceController@allNewCases')->name('crimes.new');
      Route::get('/detail/{crime}', 'PoliceController@crimeDetails')->name('crime.details');
      Route::get('/assign/{crime}', 'PoliceController@assignCase')->name('crime.assign');
      Route::get('/cases/mine', 'PoliceController@openCases')->name('crime.myCases');
      Route::get('/cases/closed', 'PoliceController@closedCases')->name('crime.closed');
      Route::get('/progress/add/{crime}', 'PoliceController@addProgress')->name('add.progress');
      Route::post('/progress/add/{crime}', 'PoliceController@saveProgress')->name('add.progress.submit');
      Route::get('/item/all', 'PoliceController@allReportedItems')->name('all_reported');
      Route::get('/item/no_owner', 'PoliceController@allNotCollected')->name('allNotCollected');
      Route::get('/item/collected', 'PoliceController@allCollected')->name('allCollected');
      Route::get('/close/{crime}', 'PoliceController@endCase')->name('case.close');
   });
});
