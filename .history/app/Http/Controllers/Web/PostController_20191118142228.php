<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Post;
use App\Http\Services\PostService;

class PostController extends Controller
{

    public function index(Request $request)
    {   
       $post = Post::paginate(5);
    }

    // public function getAllPosts() 
    // {
    //     $posts = $this->postService->getAllPosts();
    //     dd($posts);
        // return view('post.index', compact('items'));
    // }
}
