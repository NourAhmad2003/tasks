<?php

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use PHPUnit\Framework\Constraint\Operator;
use Illuminate\Support\Facades\DB;

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
    $tasks =DB::table(table:'tasks')->get();
    return view('tasks',data:compact(var_name: 'tasks'));
});
Route::post('/create', function () {
    $taskName = $_POST['name'];
    DB::table('tasks')->insert(['name' => $taskName]);
    return redirect()->back();
});
Route::post('delete/{id}',function($id){
   //DB::table(table:'tasks')->where(column:'id', operator: $id)->delete();
   DB::table(table:'tasks')->where(column:'id', operator:'=',value: $id)->delete();
   return redirect()->back();
});
Route::post('edit/{id}',function($id){
    $task = DB::table(table:'tasks')->where(column:'id', operator: $id)->first();
    $tasks =DB::table(table:'tasks')->get();
    return view('tasks',data:compact('task','tasks'));
});
Route::post('update', function() {
    $id = $_POST['id'];
    DB::table('tasks')->where('id', '=', $id)->update(['name' => $_POST['name']]);
    return redirect('tasks');
});
