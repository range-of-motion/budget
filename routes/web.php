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
    Route::get('/earnings/{earning}', 'EarningsController@show')->name('earnings.show')->middleware('can:view,earning');
    Route::delete('/earnings/{earning}', 'EarningsController@destroy')->middleware('can:delete,earning');

    Route::get('/spendings/create', 'SpendingsController@create')->name('spendings.create');
    Route::post('/spendings', 'SpendingsController@store');
    Route::get('/spendings/{spending}', 'SpendingsController@show')->name('spendings.show')->middleware('can:view,spending');
    Route::delete('/spendings/{spending}', 'SpendingsController@destroy')->middleware('can:delete,spending');

    Route::get('/budgets/create', 'BudgetsController@create')->name('budgets.create');
    Route::post('/budgets', 'BudgetsController@store');

    Route::get('/tags', 'TagsController@index')->name('tags');
    Route::get('/tags/create', 'TagsController@create')->name('tags.create');
    Route::post('/tags', 'TagsController@store');
    Route::get('/tags/{tag}/edit', 'TagsController@edit')->name('tags.edit')->middleware('can:update,tag');
    Route::patch('/tags/{tag}', 'TagsController@update')->middleware('can:update,tag');
    Route::delete('/tags/{tag}', 'TagsController@destroy')->middleware('can:delete,tag');

    Route::get('/settings', 'SettingsController@index')->name('settings');
    Route::post('/settings', 'SettingsController@store');
});

Route::get('/logout', 'LogoutController@index')->name('logout');
