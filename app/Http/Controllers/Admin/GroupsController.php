<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Groups;
use Illuminate\Support\Facades\Auth;
use App\Models\Modules;

class GroupsController extends Controller
{
    public function index()
    {
        $lists = Groups::all();
        return view('admin.groups.lists', compact('lists'));
    }
    public function add()
    {
        return view('admin.groups.add');
    }
    public function postAdd(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:groups,name',

            ],
            [

                'name.required' => 'Tên không được để trống',
                'name.unique' => 'Trùng tên',

            ]
        );
        $user = new Groups();
        $user->name = $request->name;
        $user->user_id = Auth::user()->id;
        $user->save();
        return redirect()->route('admin.groups.index')->with('msg', 'Thêm nhóm thành công');
    }
    public function edit(Groups $group)
    {
        return view('admin.groups.edit', compact('group'));
    }
    public function postEdit(Groups $group, Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:groups,name,' . $group->id,
            ],
            [
                'name.required' => 'Tên không được để trống',
                'name.unique' => 'Tên nhóm bị trùng',
            ]
        );
        $group->name = $request->name;

        $group->save();
        return back()->with('msg', 'Cập nhật nhóm thành công...');
    }
    public function delete(Groups $group)
    {
        $userCount = $group->users()->count();
        if ($userCount == 0) {
            Groups::destroy($group->id);
            return redirect()->route('admin.groups.index')->with('msg', 'Xóa nhóm thành công');
        }
        return redirect()->route('admin.groups.index')->with('msg', 'Trong nhóm vẫn còn '.$userCount.' người dùng.');
    }
    public function permission(Groups $group)
    {
        $modules = Modules::all();
        $roleListArr =[
            'view'=>'Xem',
            'add'=>'Thêm',
            'edit'=>'Sửa',
            'delete'=>'Xóa',
            // 'permission'=>'Phân quyền',
        ];
        return view('admin.groups.permission',compact('group','modules','roleListArr'));
    }
    public function postPermission(Groups $group,Request $request){
        if (!empty($request->role)) {
            $roleArr = $request->role;
        }else{
            $roleArr=[];
        }
        $roleJson = json_encode($roleArr);

        $group->permissions = $roleJson;
        $group->save();
        return back()->with('msg','phân quyền thành công');
    }
}
