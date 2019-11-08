<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CommentRequest;
use App\Http\Services\CommentService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CommentController extends MainController
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index(CommentRequest $request)
    {
        
    }

    public function getAllComments(CommentRequest $request) 
    {
        $comments = $this->commentService->getAllComments($request);
        return $this->jsonOut([
            'data' => $comments->get()
        ]);
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
    public function store(CommentRequest $request)
    {
        $comment = $this->commentService->create($request);
        return $this->jsonOut([
            'data' => $comment
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    // public function destroy()
    // {   
    //     // $comment = DB::table('comments')->where('user_id', '=', cuser()->id)->delete();
    //     return $this->jsonOut([
    //         "data" => "s"
    //     ]);
    // }
    public function countComments(Request $request)
    {
        $count = DB::table('comments')->where('post_id', '=', $request->id)->count("*");
        // return $count;
        return $this->jsonOut([
            "data" => $count
        ]);
    }

    public function deleteComment(Request $request)
    {
        $comment = DB::table('comments')->where([['user_id', '=', cuser()->id],['id', '=', $request->id]])->delete();
        return $this->jsonOut([
            "business_code" => $comment
        ]);
    }
}
