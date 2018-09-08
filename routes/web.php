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
Route::get('/AddArticle','manager@add_articles');
Route::Post('/AddArticle','manager@add_articles');
Route::get('/view','manager@view');
Route::POST('/view','manager@view');
Route::get('/read/{id}','manager@read');
Route::Post('/read/{id}','manager@read');
Route::get('edit_profile','manager@edit_profile');
Route::post('edit_profile','manager@update_account');
Route::get('profile/{id}','manager@viewprofile');
Route::POST('/like','manager@like')->name('like');
Route::POST('/best','manager@best')->name('best');
Route::POST('/dislike','manager@dislike')->name('dislike');
Route::get('statistics','manager@statistics');
Route::get('/best_articles','manager@view_best_articles');
Route::get('/contact','manager@contact');
Route::get('/arts','manager@arts');
Route::get('/business','manager@business');
Route::get('/sport','manager@sport');
Route::get('/history','manager@history');
Route::get('/politics','manager@politics');
Route::get('/science','manager@science');
Route::get('/sex','manager@sex');
Route::get('/crime','manager@crime');
Route::get('/tech','manager@tech');
Route::get('/world','manager@world');
//search
Route::get('/live_search', 'LiveSearch@index');
Route::get('/live_search/action', 'LiveSearch@action')->name('live_search.action');


//factory(App\User::class, 60)->create();
//factory(App\Article::class, 60)->create();