<?php

Route::get('/', 'IndexController@index')->name('index');

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@store');

Route::get('/register', 'RegisterController@index')->name('register');
Route::post('/register', 'RegisterController@store');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'DashboardController')->name('dashboard');

    Route::resource('/earnings', 'EarningController')->only([
        'index',
        'create',
        'store',
        'edit',
        'update',
        'destroy'
    ]);

    Route::resource('/spendings', 'SpendingController')->only([
        'index',
        'create',
        'store',
        'destroy'
    ]);

    Route::resource('/recurrings', 'RecurringController')->only([
        'index',
        'create',
        'store',
        'show'
    ]);

    Route::resource('/tags', 'TagController')->only([
        'index',
        'create',
        'store',
        'edit',
        'update',
        'destroy'
    ]);

    Route::name('imports.')->group(function () {
        Route::get('/imports', 'ImportController@index')->name('index');
        Route::get('/imports/create', 'ImportController@create')->name('create');
        Route::post('/imports', 'ImportController@store')->name('store');
    });

    Route::get('/settings', 'SettingsController@index')->name('settings');
    Route::post('/settings', 'SettingsController@store');

    Route::get('/spaces/{id}', function ($id) {
        // TODO CHECK IF SPACE IS ACCESSIBLE BY USER

        $space = App\Space::find($id);

        session(['space' => $space]);

        return redirect()->route('dashboard');
    });
});

Route::get('/logout', 'LogoutController@index')->name('logout');
