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
use App\Http\Controllers\AuthController;

Route::get('/signin', [AuthController::class, 'showSignIn'])->name('user.loginUserGet');
Route::get('/signup', [AuthController::class, 'showSignUp'])->name('user.createUserGet');

Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/user/login', [UserController::class, 'loginUserGet'])->name('user.loginUserGet');
Route::post('/user/login', [UserController::class, 'loginUserPost'])->name('user.loginUserPost');
Route::get('/user/register', [UserController::class, 'createUserGet'])->name('user.createUserGet');
Route::post('/user/register', [UserController::class, 'createUserPost'])->name('user.createUserPost');
Route::post('/user/edit', [UserController::class, 'editUser'])->name('user.editUser');
Route::put('/user/edit', [UserController::class, 'editUserPost'])->name('user.editUserPost');
Route::post('/user/logout', [UserController::class, 'logoutUser'])->name('user.logoutUser');
Route::get('/user/personal_area', [UserController::class, 'personalArea'])->name('user.personalArea');
Route::get('/position/details/{id}', [PositionController::class, 'showPositionDetailsGet'])->name('position.showDetails');
Route::post('/position/seeker_status_set', [PositionController::class, 'seekerStatusSet'])->name('position.seekerStatusSet');
Route::post('/position/candidate_status_set', [PositionController::class, 'candidateStatusSet'])->name('position.candidateStatusSet');
Route::post('/position/go_to_chat', [PositionController::class, 'goToChat'])->name('position.goToChat');
Route::post('/position/appoint_status_set', [PositionController::class, 'appointStatusSet'])->name('position.appointStatusSet');
Route::post('/position/reject_status_set', [PositionController::class, 'rejectStatusSet'])->name('position.rejectStatusSet');
Route::get('/position/redirect', [PositionController::class, 'redirectToPageBasedOnRole'])->name('position.redirectToPageBasedOnRole');
Route::get('/position/create_position', [PositionController::class, 'createPositionGet'])->name('position.createPositionGet');
Route::post('/position/create_position', [PositionController::class, 'createPositionPost'])->name('position.createPositionPost');
Route::post('/position/edit_position', [PositionController::class, 'editPosition'])->name('position.editPosition');
Route::put('/position/edit_position', [PositionController::class, 'editPositionPost'])->name('position.editPositionPost');
Route::get('/position/create_department', [PositionController::class, 'createDepartmentGet'])->name('position.createDepartmentGet');
Route::post('/position/create_department', [PositionController::class, 'createDepartmentPost'])->name('position.createDepartmentPost');
Route::get('/position/create_role', [PositionController::class, 'createRoleGet'])->name('position.createRoleGet');
Route::post('/position/create_role', [PositionController::class, 'createRolePost'])->name('position.createRolePost');
Route::get('/position/create_knowledge', [PositionController::class, 'createKnowledgeGet'])->name('position.createKnowledgeGet');
Route::post('/position/create_knowledge', [PositionController::class, 'createKnowledgePost'])->name('position.createKnowledgePost');

Route::get('/position/work_area/manyRoles', [WorkAreaController::class, 'manyRoles'])->name('workArea.manyRoles');
Route::get('/position/work_area/administrator', [WorkAreaController::class, 'administrator'])->name('workArea.administrator');
Route::get('/position/work_area/HR_manager', [WorkAreaController::class, 'HR_manager'])->name('workArea.HR_manager');
Route::get('/position/work_area/CEO', [WorkAreaController::class, 'CEO'])->name('workArea.CEO');



