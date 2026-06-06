<?php

namespace App\Http\Controllers;

use App\Models\User; // استدعاء موديل الـ User لاستخدامه في الـ Eloquent
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        // $users = DB::table('users')->get();
        $users = User::all();

        return view('users', compact('users'));
    }

    // إضافة مستخدم جديد
    public function create(Request $request): RedirectResponse
{
    // تعديل الشروط لتصبح اختيارية ومرنة، وحذف شرط الـ 6 خانات
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email', // أزلنا شرط الـ unique إذا كنتِ تريدين السماح بالتكرار مؤقتاً
        'password' => 'required',     // أزلنا شرط الـ min:6
    ]);

    $user = new User();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('password'));
    $user->save();

    return redirect()->back();
}

    // جلب بيانات مستخدم معين للتعديل وعرضه مع القائمة
    public function edit($id): View
    {
        // $user = DB::table('users')->where('id', $id)->first();
        // $users = DB::table('users')->get();

        // تحويل إلى Eloquent Model:
        $user = User::findOrFail($id);
        $users = User::all();

        return view('users', compact('user', 'users'));
    }

    // تحديث بيانات المستخدم
    public function update(Request $request): RedirectResponse
    {
        // $id = $_POST['id'];
        $id = $request->input('id');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        // $name = $_POST['name'];
        // $email = $_POST['email'];
        // $updateData = [
        //     'name' => $name,
        //     'email' => $email,
        //     'updated_at' => now()
        // ];
        // if (!empty($_POST['password'])) {
        //     $updateData['password'] = Hash::make($_POST['password']);
        // }
        // DB::table('users')->where('id', '=', $id)->update($updateData);

        // تحويل إلى Eloquent Model:
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        return redirect('users');
    }

    public function destroy($id): RedirectResponse
    {
        // DB::table('users')->where('id', '=', $id)->delete();

        // تحويل إلى Eloquent Model:
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back();
    }
}
