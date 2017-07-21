<?php

Route::get('/login', 'LoginController@index')->name('login_get');
Route::post('/login', 'LoginController@store')->name('login_post');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard_get');

Route::get('/logout', 'LogoutController@index')->name('logout_get');
