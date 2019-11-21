<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Comment;
use App\Http\Models\Post;
use App\Http\Services\PostService;

class PostController extends Controller
{

    protected $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {   
       $items = Post::with('user')->paginate(5);

       return view('post.index',compact('items'));
    }

    public function showAllCommentsOfPost(Request $request)
    {   
       $items = Comment::where('post_id', $request->id)->with('user')->paginate(5);
       
       return view('post.comments',compact('items'));
    }

    public function destroy($id)
    {
        $this->postService->delete($id);

        return redirect('posts');
    }

    public function deleteComment($id)
    {
        $model = Comment::findOrFail($id);
        $model->delete();

        return redirect('posts/showAllCommentsOfPost');
    }
}
