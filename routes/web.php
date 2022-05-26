<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

// Route::get('/user', function () {
//     return view('profile');
// });

Route::get('/articles', function(){
    return 'List Articles';
});

#redirect route
Route::redirect('/here','/there');
Route::get('/there', function() {
    return 'In there route path.';
});

#view route
// Route::view('/profile','profile',['name'=>'Taylor']);

#Route Parameters & Optional Parameters
Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return 'Post ID: '.$postId. "\n Comment ID: ".$commentId;
});

// Route::get('/user/{name?}', function($name = null){
//     return view('profile', ['name'=>$name]);
// });

#Regular Expression Constraints (Checking condition)
// Route::get('/user/{name}', function($name){
//     return view('profile', ['name'=>$name]);
// });   //->where('name', '[A-Za-z]+')

Route::get('/user/{id}/{name}', function($id, $name){
    return 'User ID: '.$id.'<br> User Name: '.$name;
})->name('user');  //->where(['id'=>'[0-9]+', 'name'=>'[A-Za-z]+'])

#Giving global constraints of route parameters in { boot method } of RouteServiceProvider

#Naming Route: only for use in internal program.
// Route::get('user/profile', function(){
//     $url = route('profile');
//     return $url;
// })->name('profile');

// Route::get('redirect', function(){
//     return redirect()->route('user',[]);
// })->name('profile');


#Route Group Prefix 
// Route::prefix()

Route::get('api/users/{user}', function (App\User $user) {
    return  $user->name."<br>email:".$user->email;
    });

#Prefix Route

Route::prefix('admin')->group(function(){
    Route::get('users', function(){
        return 'admin/users';
    });
    Route::get('players', function(){
        return 'admin/players';
    });

});




# Home app routes

// Route::get('/', function(){
//     return View::make('pages.home');
// });

// Route::get('/about', function(){
//     return View::make('pages.contact');
// });

// Route::get('/contact', function(){
//     return View::make('pages.contact');
// });

// Route::get('user/profile', function(){
//     return View::make('pages.profile');
// })->name('profile');

#Resource Route to resource controller

Route::resource('photos', PhotoController::class);
