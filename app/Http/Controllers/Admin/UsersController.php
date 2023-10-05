<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $lists = User::all();
        return view('admin.users.lists',compact('lists'));
    }
    public function add()
    {
        return view('admin.users.add');
    }
    public function edit(User $user)
    {
        return view('admin.users.edit');
    }
    public function postEdit(User $user)
    {
       
    }
    public function delete(User $user)
    {
        
    }
}
