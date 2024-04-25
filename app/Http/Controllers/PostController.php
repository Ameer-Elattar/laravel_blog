<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\storePostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    function __construct(){
        $this->middleware("auth");
    }
    function index(){
        $posts = Post::with('user')->paginate(6);
        return view("posts.index", ["posts" => $posts]);
    }

    function create(){
        return view("posts.create");
    }

    function store(storePostRequest $request){

        $post = Post::create([
            'title' => $request->title,
            'body'=> $request->body,
            'user_id'=>Auth::id(),
            'image' => $request->file('image'),
        ]);
        return redirect("/posts");
    }

    function show($id){
        $post = Post::find($id);
        // dd($post);
        return view("posts.show", ["post"=> $post]);
    }
    function edit($id, Request $request){
        $post = Post::find($id);
        if (!$post) {
            abort(404);
        }
        return view("posts.edit", ["post"=> $post]);
    }

    function update($id, storePostRequest $request){
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::id();
        $post->save();
        return redirect("/posts");

    }
    function destroy($id){
    
        $post = Post::findOrFail($id);
        $post->deleteImage();
        $post->delete();
        // Post::destroy($id);
        return redirect("/posts");
    }
}
