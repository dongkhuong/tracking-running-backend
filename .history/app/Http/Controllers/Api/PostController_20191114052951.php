<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Comment;
use App\Http\Requests\Api\PostRequest;
use App\Http\Services\PostService;
use Illuminate\Support\Facades\DB;

class PostController extends MainController
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $posts = $this->postService->getList($request);
        return $this->jsonOut([
            'data' => $posts->paginate()
        ]);
    }

    public function getAllPosts() 
    {
        $posts = $this->postService->getAllPosts();
        return $posts;
    }
 
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $post = $this->postService->create($request);
        return $this->jsonOut([
            'business_code' => 1,
            'data' => $post
        ]);
    }

    public function show(Post $post)
    {
        //
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function showPostInGroup(Request $request) {
        $posts = $this->postService->showPostInGroup($request->group_id);
        return $this->jsonOut([
            'business_code' => 1,
            'data' => $posts->paginate()
        ]);
    }

    public function deletePost(Request $request) 
    {
        $post = Post::where([['user_id', cuser()->id],['id', $request->id]])->delete();
        return $this->jsonOut([
            'business_code' => $post
        ]);
    }
}
