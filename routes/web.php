<?php

Route::get('/', 'IndexController@index')->name('index');

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@store');

Route::get('/register', 'RegisterController@index')->name('register');
Route::post('/register', 'RegisterController@store');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'DashboardController')->name('dashboard');

    Route::get('/earnings', 'EarningController@index')->name('earnings.index');
    Route::get('/earnings/create', 'EarningController@create')->name('earnings.create');
    Route::post('/earnings', 'EarningController@store');
    Route::delete('/earnings/{earning}', 'EarningController@destroy')->middleware('can:delete,earning');

    Route::get('/spendings', 'SpendingsController@index')->name('spendings.index');
    Route::get('/spendings/create', 'SpendingsController@create')->name('spendings.create');
    Route::post('/spendings', 'SpendingsController@store');
    Route::delete('/spendings/{spending}', 'SpendingsController@destroy')->middleware('can:delete,spending');

    Route::resource('/recurrings', 'RecurringController')->only(['index', 'show']);

    Route::resource('/tags', 'TagController')->only([
        'create',
        'store',
        'edit',
        'update',
        'destroy'
    ]);

    Route::get('/settings', 'SettingsController@index')->name('settings');
    Route::post('/settings', 'SettingsController@store');
});

Route::get('/logout', 'LogoutController@index')->name('logout');
