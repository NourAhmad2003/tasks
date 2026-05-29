<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    // عرض قائمة المستخدمين (ولو في مستخدم جاي للتعديل بيمرره معهم)
    public function index(): View
    {
        $users = DB::table('users')->get();

        return view('users', compact('users'));
    }

    // إضافة مستخدم جديد (زي دالة create في التاسك)
    public function create(Request $request): RedirectResponse
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        // تشفير كلمة المرور لحماية الحسابات في قاعدة البيانات
        $password = Hash::make($_POST['password']);

        DB::table('users')->insert([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back();
    }

    // جلب بيانات مستخدم معين للتعديل وعرضه مع القائمة
    public function edit($id): View
    {
        $user = DB::table('users')->where('id', $id)->first();
        $users = DB::table('users')->get();

        return view('users', compact('user', 'users'));
    }

    // تحديث بيانات المستخدم (زي دالة update في التاسك)
    public function update(): RedirectResponse
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        // تجهيز البيانات المراد تحديثها
        $updateData = [
            'name' => $name,
            'email' => $email,
            'updated_at' => now()
        ];

        // لو المستخدم كتب كلمة مرور جديدة، بنحدثها
        if (!empty($_POST['password'])) {
            $updateData['password'] = Hash::make($_POST['password']);
        }

        DB::table('users')->where('id', '=', $id)->update($updateData);

        return redirect('users');
    }

    // حذف مستخدم (زي دالة destroy في التاسك)
    public function destroy($id): RedirectResponse
    {
        DB::table('users')->where('id', '=', $id)->delete();

        return redirect()->back();
    }
}
