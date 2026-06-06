<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use PHPUnit\Framework\Constraint\Operator;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    $firstName = 'Nour';
    $lastName = 'Abo Al Rouse';
    $arrays = [
        '1' => 'Technical ',
        '2' => 'Programming',
        '3' => 'Laravel'];

    /*return view('about')-> with('firstName', $firstName)
       ->with('lastName', $lastName); */
    // return view('about', data:...['firstName' => $firstName, 'lastName' => $lastName]);
    // return view('about', data: compact('firstName', 'lastName'));
    return view('about', ['firstName' => $firstName, 'lastName' => $lastName, 'arrays' => $arrays]);
});

Route::post('/about', function () {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $arrays = [
        '1' => 'Technical ',
        '2' => 'Programming',
        '3' => 'Laravel'];

    return view('about', compact('firstName', 'lastName', 'arrays'));
});

Route::get('/tasks', action: [TaskController::class, 'index']);
Route::post('/create', action: [TaskController::class, 'create']);
Route::post('delete/{id}', action: [TaskController::class, 'destroy']);
Route::post('edit/{id}', action: [TaskController::class, 'edit']);
Route::post('update', action: [TaskController::class, 'update']);

Route::get('app', action: function (): View {
    return view(view:'layouts.app');
});

Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::post('users/create', [UserController::class, 'create'])->name('users.create');
Route::get('users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::post('users/update', [UserController::class, 'update'])->name('users.update');
