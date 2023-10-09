<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Groups;

class PostsController extends Controller
{
    public function index()
    {
        $lists = Post::all();
        return view('admin.posts.lists', compact('lists'));
    }
    public function add()
    {
        return view('admin.posts.add');
    }
    public function postAdd(Request $request){
        $request->validate(
            [
                'title' => 'required',
                'content'=>'required',
            ],
            [

                'title.required' => 'Tiêu đề không được để trống',
                'content.required' => 'Nội dung không được để trống',
            ]
        );
    $post = new Post();
    $post->title = $request->title;
    $post->content = $request->content;
    $post->user_id = Auth::user()->id;
    $post->save();
        return redirect()->route('admin.posts.index')->with('msg', 'Thêm bài viết thành công');
    }
    public function edit(Post $post) {
        return view('admin.posts.edit',compact('post'));
    }
    public function postEdit(Post $post,Request $request) {
        $request->validate(
            [
                'title' => 'required',
                'content'=>'required',
            ],
            [
                'title.required' => 'Tên không được để trống',
                'content.required' => 'Nội dung không được để trống',
            ]
        );
        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();
        return back()->with('msg', 'Cập nhật bài viết thành công...');
    }
    public function delete(Post $post){
       
            Post::destroy($post->id);
            return redirect()->route('admin.posts.index')->with('msg', 'Xóa bài viết thành công');
        
        
    }
}
