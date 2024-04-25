<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\storePostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    function index(){
        $posts = Post::with('user')->paginate(6);
        return PostResource::collection($posts);
    }

    function store(storePostRequest $request){
        // $request->accepts("");
        $post = Post::create([
            'title' => $request->title,
            'body'=> $request->body,
            'user_id'=>$request->user_id,
            'image' => $request->file('image'),
        ]);
        return "Post added successfully";
    }

    function show($id){
        $post = Post::find($id);
        return new PostResource($post);
    }


    function update($id, storePostRequest $request){
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post->save();
        return "Post Updated";

    }
    function destroy($id){
    
        $post = Post::findOrFail($id);
        $post->deleteImage();
        $post->delete();
        // Post::destroy($id);
        return "Post deleted";
    }
}
