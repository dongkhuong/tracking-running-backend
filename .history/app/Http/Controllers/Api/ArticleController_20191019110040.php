<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\Article;
use App\Http\Requests\Api\ArticleRequest;
use App\Http\Services\ArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends MainController
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }
    /**
     * Create article
     *
     * @param ArticleRequest $request request
     *
     * @return JsonResponse
     */
    public function store(ArticleRequest $request)
    {
        $inputs = $request->except('author_id');;
        $image = $request->file('image');
        $inputs['image'] = $image;

        $article = $this->articleService->create($inputs);

        return $this->jsonOut([
            'data' => $article,
        ]);
    }

    /**
     * Get detail article
     *
     * @param $article
     * @return JsonResponse
     */
    public function show($article)
    {
        $article = $this->articleService->getDetail($article);

        return view('article.content', compact('article'));
    }

    /**
     * Get lít article
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        // $article = $this->articleService->getList($request->all());

        $article = Article::all();
        return $this->jsonOut([
            'data' => $article->paginate(),
        ]);
    }

    /**
     * Delete article
     *
     * @param $article
     *
     * @return JsonResponse
     */
    public function destroy($article)
    {
        $this->articleService->delete($article);

        return $this->jsonOut([
            'statusCode' => JsonResponse::HTTP_NO_CONTENT
        ]);
    }

    /**
     * Update article
     *
     * @param \App\Http\Requests\Api\ArticleRequest $request
     * @param $article
     * @return JsonResponse
     */
    public function update(ArticleRequest $request, $article)
    {
        $inputs = $request->except('author_id');

        if ($request->has('image')) {
            $image = $request->file('image');
            $inputs['image'] = $image;
        }

        $article = $this->articleService->update($article, $inputs);

        return $this->jsonOut([
            'data' => $article,
        ]);
    }

    /**
     * Display Api Term
     *
     * @return mixed
     */
    public function apiTerm()
    {
        $model = $this->articleService->getByType(Article::TYPE_TERM);

        return view('article.term-policy', compact('model'));
    }

    /**
     * Display Api Policy
     *
     * @return mixed
     */
    public function apiPolicy()
    {
        $model = $this->articleService->getByType(Article::TYPE_POLICY);

        return view('article.term-policy', compact('model'));
    }
}
