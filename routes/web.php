<?php

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
| Define the routes for your Frontend pages here
|
*/

Route::get('/', [
    'as' => 'home', 'uses' => 'AuthController@login'
]);

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Route group for Backend prefixed with "admin".
| To Enable Authentication just remove the comment from Admin Middleware
|
*/

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    // Dashboard
    //----------------------------------

    Route::get('/', [
        'as' => 'admin.dashboard', 'uses' => 'DashboardController@index'
    ]);

    Route::get('/dashboard/basic', [
        'as' => 'admin.dashboard.basic', 'uses' => 'DashboardController@basic'
    ]);

    Route::get('/dashboard/ecommerce', [
        'as' => 'admin.dashboard.ecommerce', 'uses' => 'DashboardController@ecommerce'
    ]);

    Route::get('/dashboard/finance', [
        'as' => 'admin.dashboard.finance', 'uses' => 'DashboardController@finance'
    ]);


    // Login, Register & Maintenance Pages
    //----------------------------------

    Route::get('login-2', [
        'as' => 'admin.login-2', 'uses' => 'Demo\PagesController@login2'
    ]);

    Route::get('login-3', [
        'as' => 'admin.login-3', 'uses' => 'Demo\PagesController@login3'
    ]);

    Route::get('register-2', [
        'as' => 'admin.register-2', 'uses' => 'Demo\PagesController@register2'
    ]);

    Route::get('register-3', [
        'as' => 'admin.register-3', 'uses' => 'Demo\PagesController@register3'
    ]);

    Route::get('maintenance', [
        'as' => 'admin.maintenance', 'uses' => 'Demo\PagesController@maintenance'
    ]);

    // Icon Preview Pages
    //----------------------------------

    Route::group(['prefix' => 'icons'], function () {

        Route::get('/icomoon', [
            'as' => 'admin.icons.icomoon', 'uses' => 'Demo\PagesController@icoMoons'
        ]);

        Route::get('/evil', [
            'as' => 'admin.icons.evil', 'uses' => 'Demo\PagesController@evilIcons'
        ]);

        Route::get('/meteo', [
            'as' => 'admin.icons.meteo', 'uses' => 'Demo\PagesController@meteoIcons'
        ]);

        Route::get('/line', [
            'as' => 'admin.icons.line', 'uses' => 'Demo\PagesController@lineIcons'
        ]);

        Route::get('/fps-line', [
            'as' => 'admin.icons.fpsline', 'uses' => 'Demo\PagesController@fpsLineIcons'
        ]);

        Route::get('/fontawesome', [
            'as' => 'admin.icons.fontawesome', 'uses' => 'Demo\PagesController@fontawesomeIcons'
        ]);
    });

    // Todos
    //----------------------------------

    Route::post('user/add-new', [
        'as' => 'admin.user.create', 'uses' => 'UsersController@create'
    ]);

    Route::get('users/admin', [
        'as' => 'admin.user.admin', 'uses' => 'UsersController@getAdmin'
    ]);

    Route::get('user/profile', ['as' => 'admin.user.profile', 'uses' => 'UsersController@show']);

    Route::get('users/khach_hang', [
        'as' => 'admin.user.khachhang', 'uses' => 'UsersController@getKhachHang'
    ]);
    Route::get('users/nhan_vien', [
        'as' => 'admin.user.nhanvien', 'uses' => 'UsersController@getNhanVien'
    ]);

    Route::get('users/delete/{id}', [
        'as' => 'users.delete', 'uses' => 'UsersController@destroy'
    ]);

    Route::get('users/hoadon/{id}', [
        'as' => 'users.hoadon', 'uses' => 'UsersController@getHoaDon'
    ]);

    Route::resource('giadien', 'GiaDienController');

    Route::get('giadien/delete/{id}', [
        'as' => 'giadien.delete', 'uses' => 'GiaDienController@destroy'
    ]);

    Route::resource('loaidien', 'LoaiDienController');

    Route::get('loaidien/delete/{id}', [
        'as' => 'loaidien.delete', 'uses' => 'LoaiDienController@destroy'
    ]);

    Route::resource('users', 'UsersController');

//    Route::resource('dienke', 'DienKeController');
//    Route::get('dienke/delete/{id}', [
//        'as' => 'dienke.delete', 'uses' => 'DienKeController@destroy'
//    ]);

    Route::get('users/hoadon/xacnhan/{id}', [
        'as' => 'hoadon.xacnhan', 'uses' => 'HoaDonController@update'
    ]);

    Route::resource('muc-cap-dien', 'MucCapDienController');
    Route::resource('khu-vuc', 'KhuVucController');
    Route::resource('dksd-dien', 'DKSDDienController');
    Route::resource('hoa-don', 'HoaDonController');
    Route::get('dien-ke', 'HoaDonController@index');
    Route::post('hoa-dơn/create-auto', 'HoaDonController@createAuto')->name('hoa-don.create.auto');
    Route::post('hoa-dơn/update-auto', 'HoaDonController@updateAuto')->name('hoa-don.update.auto');
    Route::get('thong-ke', 'ThongKeController@index')->name('thong-ke.index');
    Route::get('thong-ke/khach-hang', 'ThongKeController@khachHang')->name('thong-ke.kh');
    // Settings
    //----------------------------------
});

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
| Guest routes cannot be accessed if the user is already logged in.
| He will be redirected to '/" if he's logged in.
|
*/

Route::group(['middleware' => ['guest']], function () {

    Route::get('login', [
        'as' => 'login', 'uses' => 'AuthController@login'
    ]);

    Route::get('register', [
        'as' => 'register', 'uses' => 'AuthController@register'
    ]);

    Route::post('login', [
        'as' => 'login.post', 'uses' => 'AuthController@postLogin'
    ]);

    Route::get('forgot-password', [
        'as' => 'forgot-password.index', 'uses' => 'ForgotPasswordController@getEmail'
    ]);

    Route::post('/forgot-password', [
        'as' => 'send-reset-link', 'uses' => 'ForgotPasswordController@postEmail'
    ]);

    Route::get('/password/reset/{token}', [
        'as' => 'password.reset', 'uses' => 'ForgotPasswordController@GetReset'
    ]);

    Route::post('/password/reset', [
        'as' => 'reset.password.post', 'uses' => 'ForgotPasswordController@postReset'
    ]);

    Route::get('auth/{provider}', 'AuthController@redirectToProvider');

    Route::get('auth/{provider}/callback', 'AuthController@handleProviderCallback');
});

Route::get('logout', [
    'as' => 'logout', 'uses' => 'AuthController@logout'
]);

Route::get('install', [
    'as' => 'logout', 'uses' => 'AuthController@logout'
]);
