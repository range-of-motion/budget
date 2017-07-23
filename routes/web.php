<?php

Route::get('/login', 'LoginController@index')->name('login_get');
Route::post('/login', 'LoginController@store')->name('login_post');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard_get');

    Route::get('/settings', 'SettingsController@index')->name('settings_get');
});

Route::get('/logout', 'LogoutController@index')->name('logout_get');
