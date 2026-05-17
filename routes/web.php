<?php

use Illuminate\Support\Facades\Route;

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
    //return view('about')-> with('firstName', $firstName)
     //   ->with('lastName', $lastName);
        //return view('about', data:...['firstName' => $firstName, 'lastName' => $lastName]);
        //return view('about', data: compact('firstName', 'lastName'));
        return view('about', ['firstName' => $firstName, 'lastName' => $lastName, 'arrays' =>$arrays]);
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
Route::get('/tasks', function () {
    return view('tasks');
});
Route::post('/create', function () {
    $taskName = $_POST['name'];
    DB::table('tasks')->insert(['name' => $taskName]);
    return view('tasks');
});
