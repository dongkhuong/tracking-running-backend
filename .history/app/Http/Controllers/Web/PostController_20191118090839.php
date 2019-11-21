<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\PostService;

class PostController extends Controller
{
    protected $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function index(Request $request)
    {   
        $items = $this->postService->getList($request)->paginate(3);
        dd($items);
        // return view('post.index', compact('items'));
    }

    // public function getAllPosts() 
    // {
    //     $posts = $this->postService->getAllPosts();
    //     dd($posts);
        // return view('post.index', compact('items'));
    // }
}
