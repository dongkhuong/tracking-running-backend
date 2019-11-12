<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = $this->postService->create($request);
        return $this->jsonOut([
            'data' => $post
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post_id = Post::find($request->id)->where('user_id', '=', cuser()->id);
        return $post_id;
        // $post = Post::where([['user_id', '=', cuser()->id],['post_']])
    }

    public function deletePost(Request $request) 
    {
        $post = Post::where([['user_id', cuser()->id],['id', $request->id]])->delete();
        return $this->jsonOut([
            'business_code' => $post
        ]);
    }
}
