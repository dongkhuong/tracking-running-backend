<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'as' => 'api.',
    'namespace' => 'Api',
], function () {
    Route::post('login', 'UserController@login')->name('login');
    Route::post('register', 'UserController@register')->name('register');
    Route::post('verify-phone', 'SMSController@verifyPhone')->name('sms.verify-phone');
    Route::post('verify-code', 'SMSController@verifyCode')->name('sms.verify-code');
    // Authenticate
    Route::group([
        'middleware' => ['permission'],
    ], function () {
        Route::post('logout', 'UserController@logout')->name('logout');
        Route::get('users/profile', 'UserController@profile')->name('users.profile');
        Route::patch('users/update', 'UserController@update')->name('users.update');
        Route::post('users/change-password', 'UserController@changePassword')->name('users.change-password');
        Route::post('users/change-avatar', 'UserController@changeAvatar')->name('users.change-avatar');
        Route::resources([
            'activities' => 'ActivityController',
            'posts' => 'PostController',
            "comments" => "CommentController",
            "friends" => "FriendController"
        ]);
        Route::get('pendingRequest','FriendController@pendingRequest')->name('friends.pendingRequest');
        Route::get('listAllUsersYouMightKnow', 'FriendController@listAllUsersYouMightKnow');
        Route::get('getAllActivities','ActivityController@getAllActivities');
        Route::patch('acceptFriend', 'FriendController@acceptFriend')->name('friends.acceptFriend');
        Route::get('getAllPosts','PostController@getAllPosts')->name('posts.getAllPosts');
        Route::post('getAllComments', 'CommentController@getAllComments')->name('comments.getAllComments');
        Route::delete('deleteComment/{id}', 'CommentController@deleteComment')->name('comments.deleteComment');
        Route::get('countComments/{post_id}', 'CommentController@countComments')->name('comments.countComments');
        // Route::get('getWeek','ActivityController@getWeek');
        // Route::get('getActivityByWeek/{id}','ActivityController@getActivityByWeek');
    });
});
