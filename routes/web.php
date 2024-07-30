<?php

use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkAreaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [UserController::class, 'home'])->name('home');

Route::get('/user/login', [UserController::class, 'loginUserGet'])->name('user.loginUserGet');
Route::post('/user/login', [UserController::class, 'loginUserPost'])->name('user.loginUserPost');
Route::get('/user/register', [UserController::class, 'createUserGet'])->name('user.createUserGet');
Route::post('/user/register', [UserController::class, 'createUserPost'])->name('user.createUserPost');
Route::post('/user/logout', [UserController::class, 'logoutUser'])->name('user.logoutUser');
Route::get('/user/personal_area', [UserController::class, 'personalArea'])->name('user.personalArea');
//Route::get('/workArea', [PositionController::class, 'workArea'])->name('position.workArea');
Route::get('/position/{id}/redirect', [PositionController::class, 'redirectToPageBasedOnRole'])->name('position.redirectToPageBasedOnRole');
Route::get('/position/create_position', [PositionController::class, 'createPositionGet'])->name('position.createPositionGet');
Route::post('/position/create_position', [PositionController::class, 'createPositionPost'])->name('position.createPositionPost');
Route::get('/position/create_department', [PositionController::class, 'createDepartmentGet'])->name('position.createDepartmentGet');
Route::post('/position/create_department', [PositionController::class, 'createDepartmentPost'])->name('position.createDepartmentPost');
Route::get('/position/create_knowledge', [PositionController::class, 'createKnowledgeGet'])->name('position.createKnowledgeGet');
Route::post('/position/create_knowledge', [PositionController::class, 'createKnowledgePost'])->name('position.createKnowledgePost');
Route::get('/position/work_area/administrator', [WorkAreaController::class, 'administrator'])->name('workArea.administrator');
Route::put('/position/work_area/administrator_update_user/{id}', [WorkAreaController::class, 'administratorUpdateUser'])->name('workArea.administratorUpdateUser');



