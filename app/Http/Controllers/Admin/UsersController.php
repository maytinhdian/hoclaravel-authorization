<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Groups;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        if (Auth::user()->user_id==0) {
            $lists=User::all();
        }else{
            $lists=User::where('user_id',$userId)->get();
        }
        
        return view('admin.users.lists', compact('lists'));
    }
    public function add()
    {
        $groups = Groups::all();
        return view('admin.users.add', compact('groups'));
    }
    public function postAdd(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'group_id' => ['required', function ($attribute, $value, $fail) {
                    if ($value == 0) {
                        $fail('Vui lòng chọn nhóm');
                    }
                }]
            ],
            [

                'name.required' => 'Tên không được để trống',
                'email.required' => 'Tên không được để trống',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã có người sử dụng',
                'group_id.required' => 'Nhóm không được để trống',
                'passowrd.required' => 'Nhập password'
            ]
        );

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->group_id = $request->group_id;
        $user->user_id = Auth::user()->id;
        $user->save();
        return redirect()->route('admin.users.index')->with('msg', 'Thêm dữ liệu thành công...');
    }
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        
        $groups = Groups::all();
        return view('admin.users.edit', compact('groups', 'user'));
    }
    public function postEdit(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,

                'group_id' => ['required', function ($attribute, $value, $fail) {
                    if ($value == 0) {
                        $fail('Vui lòng chọn nhóm');
                    }
                }]
            ],
            [

                'name.required' => 'Tên không được để trống',
                'email.required' => 'Tên không được để trống',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã có người sử dụng',
                'group_id.required' => 'Nhóm không được để trống',

            ]
        );
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->group_id = $request->group_id;

        $user->save();
        return back()->with('msg', 'Cập nhật người dùng thành công...');
    }
    public function delete(User $user)
    {
        $this->authorize('delete', $user);
        if (Auth::user()->id != $user->id) {
            User::destroy($user->id);
            return redirect()->route('admin.users.index')->with('msg','Xóa tài khoản thành công');
        }else{
            return redirect()->route('admin.users.index')->with('msg','Bạn không thể xóa tài khoản này');
        }
    }
}
