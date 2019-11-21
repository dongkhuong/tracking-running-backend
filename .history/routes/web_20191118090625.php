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
        return view('layout.welcome');
    })->name('main');

    Route::group([
        'namespace' => 'Web',
    ], function () {
        Route::resource('login', 'LoginController')->only(['index', 'store']);
        Route::resource('register', 'RegisterController')->only(['index', 'store']);
        Route::get('register/verify/{signature}', 'RegisterController@verify')->name('register.verify');
        Route::get('register/confirm', 'RegisterController@confirm')->name('register.confirm');
        Route::get('reset-passwords', 'ResetPasswordController@index')->name('reset-password.index');
        Route::post('reset-passwords', 'ResetPasswordController@send')->name('reset-password.send');
        Route::get('reset-passwords/verify/{signature}', 'ResetPasswordController@verify')->name('reset-password.verify');
        Route::post('reset-passwords/verify', 'ResetPasswordController@update')->name('reset-password.update');
        Route::get('reset-passwords/confirm', 'ResetPasswordController@confirm')->name('reset-password.confirm');

        Route::group([
            'middleware' => ['auth', 'permission'],
        ], function () {
            Route::resources([
                'permissions' => 'PermissionController',
                'roles' => 'RoleController',
                'users' => 'UserController',
            ]);
            Route::resources([
                'activities' => 'ActivityController',
            ]);
            Route::resource('verify-codes', 'VerifyCodeController')->only(['index', 'update', 'destroy']);
            Route::resource('logout', 'LogoutController')->only(['store']);
            Route::post('item-childs/add/{name}', 'ItemChildController@add')->name('item-childs.add');
            Route::post('item-childs/remove/{name}', 'ItemChildController@remove')->name('item-childs.remove');
            Route::get('change-password', 'ChangePasswordController@index')->name('change-password.index');
            Route::post('change-password', 'ChangePasswordController@update')->name('change-password.update');
            Route::post('profiles/change-avatar', 'ProfileController@changeAvatar')->name('profiles.change-avatar');
            Route::get('profiles', 'ProfileController@index')->name('profiles.index');
            Route::post('profiles/update', 'ProfileController@update')->name('profiles.update');

            Route::get('getAllPosts', 'PostController@getAllPosts')->name('posts.index');
        });
    });
