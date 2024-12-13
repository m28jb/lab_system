<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FriendshipController;

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {

    Route::post('', [PostController::class, 'store'])->name('create');
    Route::delete('delete/{post}', [PostController::class, 'delete'])->name('delete');
    Route::put('update/{post}', [PostController::class, 'update'])->name('update');
    Route::get('edit/{post}', [PostController::class, 'edit'])->name('edit');
    Route::get('toggleLike/{post}', [PostController::class, 'toggleLike'])->name('toggleLike');
    

});




Route::middleware('auth')->group(function () {
    Route::get('/friends', [FriendshipController::class, 'listFriends'])->name('friends.list');
    Route::post('/friend-request/send/{friendId}', [FriendshipController::class, 'sendRequest'])->name('friend.send');
    Route::post('/friend-request/accept/{friendshipId}', [FriendshipController::class, 'acceptRequest'])->name('friend.accept');
    Route::post('/friend-request/decline/{friendshipId}', [FriendshipController::class, 'declineRequest'])->name('friend.decline');
});
