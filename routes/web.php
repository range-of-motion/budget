<?php

Route::get('/login', 'LoginController@index')->name('login.index');
Route::post('/login', 'LoginController@store')->name('login.store');

Route::get('/register', 'RegisterController@index');
Route::post('/register', 'RegisterController@store');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard/{year?}/{month?}', 'DashboardController@index')->name('dashboard.index');

    Route::get('/search', 'SearchController@index');

    Route::resource('/earnings', 'EarningsController', ['only' => ['index', 'create', 'store', 'destroy']]);

    Route::resource('/spendings', 'SpendingsController', ['only' => ['index', 'show', 'create', 'store', 'destroy']]);

    Route::resource('/budgets', 'BudgetsController', ['only' => ['index', 'create', 'store', 'destroy']]);

    Route::resource('/tags', 'TagsController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);

    Route::get('/settings', 'SettingsController@index')->name('settings.index');
    Route::post('/settings', 'SettingsController@store')->name('settings.store');
});

Route::get('/logout', 'LogoutController@index')->name('logout.index');
