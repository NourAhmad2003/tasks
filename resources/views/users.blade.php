@extends('layouts.app')

@section('title', 'إدارة المستخدمين')

@section('content')
    <div class="container-fluid" style="direction: rtl; text-align: right;">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ isset($user) ? 'تعديل بيانات المستخدم: ' . $user->name : 'إضافة مستخدم جديد' }}
                </h6>
            </div>
            <div class="card-body">
                @if (isset($user))
                    <form action="{{ route('users.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>الاسم</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                    required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>البريد الإلكتروني</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                    required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>كلمة المرور الجديدة (اختياري)</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="اتركها فارغة لعدم التغيير">
                            </div>
                            <div class="col-md-3 mb-3 align-self-end">
                                <button type="submit" class="btn btn-warning btn-block">تعديل</button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-block mt-1">إلغاء</a>
                            </div>
                        </div>
                    </form>
                @else
                    <form action="{{ route('users.create') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>الاسم</label>
                                <input type="text" name="name" class="form-control" placeholder="أدخل اسم المستخدم"
                                    required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>البريد الإلكتروني</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="أدخل البريد الإلكتروني" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>كلمة المرور</label>
                                <input type="password" name="password" class="form-control" placeholder="أدخل كلمة المرور"
                                    required>
                            </div>
                            <div class="col-md-3 mb-3 align-self-end">
                                <button type="submit" class="btn btn-primary btn-block">إضافة</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">قائمة المستخدمين الحالية</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="bg-light">
                            <tr>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th style="width: 150px;" class="text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $u)
                                <tr>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('users.edit', $u->id) }}" class="btn btn-sm btn-info">تعديل</a>
                                        <a href="{{ route('users.destroy', $u->id) }}" class="btn btn-sm btn-danger"
                                            onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">لا يوجد مستخدمين مضافين حالياً.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
