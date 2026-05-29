<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): Factory|View
    {
        $tasks = DB::table(table: 'tasks')->get();

        return view('tasks', data: compact(var_name: 'tasks'));
    }

    public function create(Request $request): RedirectResponse
    {
        $taskName = $_POST['name'];
        DB::table('tasks')->insert(['name' => $taskName]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        DB::table(table: 'tasks')->where(column: 'id', operator: '=', value: $id)->delete();

        return redirect()->back();
    }

    public function edit($id): Factory|View
    {
        $task = DB::table(table: 'tasks')->where(column: 'id', operator: $id)->first();
        $tasks = DB::table(table: 'tasks')->get();

        return view('tasks', data: compact('task', 'tasks'));
    }

    public function update(): RedirectResponse
    {
        $id = $_POST['id'];
        DB::table('tasks')->where('id', '=', $id)->update(['name' => $_POST['name']]);

        return redirect('tasks');
    }
    
}
