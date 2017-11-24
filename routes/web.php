<?php

Route::get('/', 'IndexController@index')->name('index');

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@store');

Route::get('/register', 'RegisterController@index')->name('register');
Route::post('/register', 'RegisterController@store');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard/{year?}/{month?}', 'DashboardController@index')->name('dashboard');

    Route::get('/search', 'SearchController@index')->name('search');

    Route::get('/earnings/create', 'EarningsController@create')->name('earnings.create');
    Route::post('/earnings', 'EarningsController@store');
    Route::get('/earnings/{id}', 'EarningsController@show')->name('earnings.show');

    Route::get('/spendings/create', 'SpendingsController@create')->name('spendings.create');
    Route::post('/spendings', 'SpendingsController@store');
    Route::get('/spendings/{id}', 'SpendingsController@show')->name('spendings.show');
    Route::delete('/spendings/{id}', 'SpendingsController@destroy')->name('spendings.destroy');

    Route::get('/budgets/create', 'BudgetsController@create')->name('budgets.create');
    Route::post('/budgets', 'BudgetsController@store');

    Route::get('/tags', 'TagsController@index')->name('tags');
    Route::get('/tags/create', 'TagsController@create')->name('tags.create');
    Route::post('/tags', 'TagsController@store');
    Route::delete('/tags/{id}', 'TagsController@destroy')->name('tags.destroy');

    Route::get('/settings', 'SettingsController@index')->name('settings');
    Route::post('/settings', 'SettingsController@store');
});

Route::get('/logout', 'LogoutController@index')->name('logout');
