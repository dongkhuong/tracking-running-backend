<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CommentRequest;
use App\Http\Services\CommentService;
use Illuminate\Support\Facades\DB;

class CommentController extends MainController
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function getAllComments(CommentRequest $request) 
    {
        $comments = $this->commentService->getAllComments($request);
        return $this->jsonOut([
            'data' => $comments->get()
        ]);
    }
  
    public function store(CommentRequest $request)
    {
        $comment = $this->commentService->create($request);
        return $this->jsonOut([
            'data' => $comment
        ]);
    }

    public function countComments(Request $request)
    {
        $count = DB::table('comments')->where('post_id', '=', $request->id)->count();
        return $this->jsonOut([
            'number_of_comments' => $count
        ]);
    }

    public function deleteComment(Request $request)
    {
        $comment = DB::table('comments')->where([['user_id', '=', cuser()->id],['id', '=', $request->id]])->delete();
        return $this->jsonOut([
            'business_code' => $comment
        ]);
    }
}
