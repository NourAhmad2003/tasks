<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Faker\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index()
    {
        // $tasks = DB::table(table: 'tasks')->get();
        $tasks = Task::all();

        return view('tasks', compact('tasks'));
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3|max:10',
        ]);

        // $taskName = $_POST['name'];
        $taskName = $request->input('name');

        // DB::table('tasks')->insert(['name' => $taskName]);
        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        //DB::table(table: 'tasks')->where(column: 'id', operator: '=', value: $id)->delete();
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect('/tasks')->with('success', 'Task deleted successfully');
    }

    public function edit($id)//: Factory|View (تم تعليقها لتجنب مشاكل استيراد كلاس الـ Factory غير المستخدم)
    {
        // $task = DB::table(table: 'tasks')->where(column: 'id', operator: $id)->first();
        // $tasks = DB::table(table: 'tasks')->get();

        $task = Task::findOrFail($id);
        $tasks = Task::all(); // جلب كل المهام ليتم عرضها في الجدول بجانب العنصر المراد تعديله

        return view('tasks', data: compact('task', 'tasks'));
    }

    public function update(Request $request): RedirectResponse // تم إضافة Request $request هنا لكي يعمل الـ Validation
    {
        $request->validate([
            'name' => 'required|min:3|max:10',
        ]);

        // $id = $_POST['id'];
        $id = $request->input('id');

        //DB::table('tasks')->where('id', '=', $id)->update(['name' => $_POST['name']]);
        $task = Task::findOrFail($id);
        $task->name = $request->name;
        // $task = Task::findOrFail($id); // سطر مكرر تم تعليقه
        $task->save();
        return redirect('/tasks')->with('success', 'Task updated successfully');
    }
}
