<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        $lists = Post::all();
        return view('admin.posts.lists', compact('lists'));
    }
    public function add()
    {
        # code...
    }
    public function postAdd(Request $request){

    }
    public function edit(Post $post) {
        
    }
    public function postEdit(Post $post,Request $request) {
        
    }
    public function delete(Post $post){

    }
}
