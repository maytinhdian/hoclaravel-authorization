<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Groups;
use PHPUnit\Framework\Attributes\Group;

class GroupsController extends Controller
{
    public function index()
    {
        $lists = Groups::all();
        return view('admin.groups.lists', compact('lists'));
    }
    public function add()
    {
        # code...
    }
    public function postAdd()
    {
        # code...
 
    }
    public function edit(Groups $group){

    }
    public function postEdit(Groups $group,Request $request){

    }
    public function delete(Groups $group){

    }
}
