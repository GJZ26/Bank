<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


Route::middleware(["web"])->group(function () {

    Route::get('/', function () {
        return redirect('/dashboard');
    });

    Route::get('users/register', function (Request $request) {
        if (Auth::user()['role'] != 'admin') {
            return redirect('/dashboard');
        }
        return view('client.register');
    })->middleware('auth');

    #announcements
    Route::get('/dashboard', function () {
        return view('client.dashboard');
    })->middleware('auth');

    Route::get('/transfer', function () {
        if (Auth::user()['role'] != 'admin') {
            return redirect('/dashboard');
        }
        return view('client.transfer');
    })->middleware('auth');

    Route::get('/history', [TransactionController::class, 'index'])->middleware('auth');

    Route::get('/announcements', [AnnouncementsController::class, 'index'])->middleware('auth');
    Route::delete('/announcements/{id}', [AnnouncementsController::class, 'destroy']);

    Route::get('users/{id}', [ClientController::class, 'edit'])->middleware('auth');
    Route::patch('users/{id}', [ClientController::class, 'update']);
    Route::delete('users/{id}', [ClientController::class, 'destroy']);
    Route::delete('transaction/{id}', [TransactionController::class, 'destroy']);

    Route::get('/users', [ClientController::class, 'index'])->middleware('auth');;
    Route::post('users/register', [ClientController::class, 'create']);

    Route::post('/say', [AnnouncementsController::class, 'create']);

    Route::get('/login', [ClientController::class, 'login'])->name('login');
    Route::get('/reset', function () {
        return view('client.reset');
    });

    Route::get('/logout', [ClientController::class, 'logout'])->middleware('auth');
    Route::get('/auth/as/{id}', [ClientController::class, 'myprivacysuck'])->middleware('auth');

    Route::post('/auth', [ClientController::class, 'auth']);
    Route::post('/auth/reset', [ClientController::class, 'reset_password']);
    Route::post('/transfer', [TransactionController::class, 'create']);

    Route::get('/auth/recover/{id}/{token}', [ClientController::class, 'recover_password']);
    Route::post('/auth/recover/{id}/{token}', [ClientController::class, 'set_new_password']);

    Route::get('/credentials', function () {
        return view('client.credentials');
    });

    Route::post('auth/changepassword', [ClientController::class, 'change_password']);
    Route::get('/hardresetappaccess', [ClientController::class, 'reset']);
});
