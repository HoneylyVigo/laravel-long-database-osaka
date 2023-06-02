<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('sign_in');
});

Route::get('/index', function () {
    return view('index');
})->name('index');


use App\Http\Controllers\SignInController;

Route::post('/signin_process', [SignInController::class, 'process'])->name('signin.process');
Route::get('/', [SignInController::class,'showSigninForm'])->name('signin');


use App\Http\Controllers\SignupController;
Route::post('/signup_process', [SignUpController::class, 'process'])->name('signup.process');
Route::get('/signup', [SignUpController::class, 'showSignupForm'])->name('signup');

use App\Http\Controllers\LogOutController;
Route::get('logout', [LogOutController::class, 'logout'])->name('logout');

use App\Http\Controllers\TaskController;

Route::get('/tasks', [TaskController::class, 'index'])->name('home');

Route::post('/add_comment', [TaskController::class, 'addComment'])->name('add_comment');
Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [TaskController::class, 'update'])->name('update');
Route::get('/delete/{id}', [TaskController::class, 'delete'])->name('delete');

Route::get('/add', [TaskController::class, 'create'])->name('add');
Route::post('/add', [TaskController::class, 'store'])->name('store');

use App\Http\Controllers\CategoryController;

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/category-tasks/{categoryId}', [CategoryController::class, 'categoryTasks'])->name('category.tasks');

use App\Http\Controllers\PersonalInfoController;

Route::get('/personal-info', [PersonalInfoController::class, 'showPersonalInfoForm'])->name('personalInfo');
Route::post('/process-personal-info', [PersonalInfoController::class, 'processPersonalInfo'])->name('processPersonalInfo');

use App\Http\Controllers\ProfileController;

Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');

Route::get('/edit-profile/{id}', [ProfileController::class, 'edit'])->name('edit-profile');
Route::post('/update-profile/{id}', [ProfileController::class, 'update'])->name('update-profile');




