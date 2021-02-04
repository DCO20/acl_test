<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Users
Route::get('user/{user}/roles', [UserController::class, 'roles'])->name('user.roles');
Route::put('user/{user}/roles/sync', [UserController::class, 'rolesSync'])->name('user.rolesSync');
Route::resource('users', UserController::class);

//Roles
Route::get('role/{role}/permissions', [RoleController::class, 'permissions'])->name('role.permissions');
Route::put('role/{role}/permissions/sync', [RoleController::class, 'permissionsSync'])->name('role.permissionsSync');
Route::resource('roles', RoleController::class);

//Permissions
Route::resource('permissions', PermissionController::class);

//Posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post', [PostController::class, 'store'])->name('post.store');
Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::match(['put', 'patch'], '/post/{post}', [PostController::class, 'update'])->name('post.update');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');
Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
