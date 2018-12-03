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

Route::get('/', 'HomeController@index')
    ->name('home');

Route::get('dashboard/{id}', 'Dashboard@show')
    ->name('dashboard');

Route::group(
    [
        'prefix' => 'ajax'
    ],
    function () {
        Route::post('get_initial_date', 'AjaxDispatcher@getInitialDate')
            ->name('ajax.get_initial_date');
        Route::post('get_total_tweets', 'AjaxDispatcher@getTotalTweets')
            ->name('ajax.get_total_tweets');
        Route::post('get_daily_data', 'AjaxDispatcher@getDailyData')
            ->name('ajax.get_daily_data');
        Route::post('get_weekly_data', 'AjaxDispatcher@getWeeklyData')
            ->name('ajax.get_weekly_data');
        Route::post('get_monthly_data', 'AjaxDispatcher@getMonthlyData')
            ->name('ajax.get_monthly_data');
        Route::post('get_yearly_data', 'AjaxDispatcher@getYearlyData')
            ->name('ajax.get_yearly_data');
    }
);
