<?php

namespace App\Http\Services;

use App\Http\Models\Activity;
use App\Http\Models\AuthAssignment;

class ActivityService extends MainService
{
    use Main;
    public function getList($request)
    {
        if(cuser()->role->item_name == 'SuperAdmin'){
            $activity  = Activity::filter([
                ['distance', 'like', $request->distance],
                ['duration', 'like',  $request->duration],
                ['calories', '=',  $request->calories],
                ['average_pace', 'like',  $request->average_pace],
                ['average_speed', 'like',  $request->average_speed],
                ['max_speed', '=',  $request->max_speed],
                ['start_time', 'like',  $request->start_time],
                ['date', 'like',  $request->date],
            ]);
        } else {
            $activity  = Activity::filter([
                ['distance', 'like', $request->distance],
                ['duration', 'like',  $request->duration],
                ['calories', '=',  $request->calories],
                ['average_pace', 'like',  $request->average_pace],
                ['average_speed', 'like',  $request->average_speed],
                ['max_speed', '=',  $request->max_speed],
                ['start_time', 'like',  $request->start_time],
                ['date', 'like',  $request->date],
            ])->where('user_id',cuser()->id)->paginate();
        }
        return $activity->paginate(1);
    }
    // /**
    //  * Create article
    //  *
    //  * @param array $data data of article
    //  *
    //  * @return object
    //  */
    // public function create(array $data)
    // {
    //     $articleModel = new Article;
    //     if (isset($data['image'])) {
    //         $uploadImage = new UploadImage();
    //         $imageData = $uploadImage->store([$data['image']]);

    //         $image = new Image();
    //         $image->fill($imageData[0]);
    //         $image->save();
    //     }
    //     $articleModel->fill($data);

    //     $articleModel->image()->associate($image);
    //     $articleModel->author()->associate(cuser());

    //     $articleModel->save();

    //     $articleModel->load('image');
    //     $articleModel->load('author');

    //     return $articleModel;
    // }

    // /**
    //  * Get detail
    //  *
    //  * @param $id
    //  *
    //  * @return mixed
    //  */
    // public function getDetail($id)
    // {

    //     $article  = Article::findOrFail($id);

    //     $article->load('image');
    //     $article->load('author');

    //     return $article;
    // }

    // /**
    //  * Get list
    //  *
    //  * @param array $input
    //  *
    //  * @return mixed
    //  */
    // public function getList($request)
    // {
    //     $article  = Article::filter([
    //         ['title', 'like', $request->title],
    //         ['description', 'like',  $request->description],
    //         ['is_public', '=',  $request->is_public],
    //         ['type', '=',  $request->type]
    //     ])
    //     ->whereIn('type', [Article::TYPE_NEWS, Article::TYPE_PROMOTION])
    //     ->with(['author', 'image'])
    //     ->orderBy('articles.created_at', 'desc');

    //     return $article;
    // }

    // /**
    //  * Delete article
    //  *
    //  * @param $article
    //  *
    //  * @return mixed
    //  */
    // public function delete($article)
    // {
    //     $currentUser = cuser();
    //     $article  = Article::where('id', $article);

    //     if ($currentUser->role->item_name != AuthAssignment::ROLE_SUPER_ADMIN) {
    //         $article->where('author_id', $currentUser->id);
    //     }

    //     $articleData = $article->firstOrFail();

    //     return $articleData->delete();
    // }

    // /**
    //  * Update article
    //  *
    //  * @param $articleId
    //  * @param $data
    //  *
    //  * @return object
    //  */
    // public function update($articleId, $data)
    // {
    //     $currentUser = cuser();

    //     $article  = Article::where('id', $articleId);
    //     if ($currentUser->role->item_name != AuthAssignment::ROLE_SUPER_ADMIN) {
    //         $article->where('author_id', $currentUser->id);
    //     }

    //     $articleData = $article->firstOrFail();

    //     if (isset($data['image'])) {
    //         $uploadImage = new UploadImage();
    //         $imageData = $uploadImage->store([$data['image']]);

    //         $image = new Image();
    //         $image->fill($imageData[0]);
    //         $image->save();

    //         $articleData->image()->associate($image);
    //     }

    //     $articleData->fill($data);

    //     $articleData->save();

    //     $articleData->load('image');
    //     $articleData->load('author');

    //     return $articleData;
    // }

    // /**
    //  * Get Term or Policy
    //  *
    //  * @param string $type //type of articles
    //  * @param boolean $checkPermission //need to check permission or not
    //  *
    //  * @return mixed
    //  */
    // public function getByType($type)
    // {
    //     $model = Article::where('type', $type)->first();

    //     return $model;
    // }

    // /**
    //  * Update Term or Policy by type
    //  *
    //  * @param string $type //type of articles
    //  * @param array $data
    //  *
    //  * @return mixed
    //  */
    // public function updateByType($type, $data)
    // {
    //     $model = Article::where('type', $type)->first();
    //     if (!$model) {
    //         $model = new Article;

    //         $data['type'] =  $type;
    //         $data['is_public'] =  true;
    //         //Chổ này em đang set default để tham khảo ý kiến anh
    //         //Bảng articles đang có tilte, author_id, description là not null
    //         //Nên em set tạm đễ nó pass đã, trao đổi với anh rồi sửa đoạn này sau
    //         $data['title'] = 'temp';
    //         $data['description'] = 'temp';
    //     }
    //     $model->fill($data);

    //     $model->author()->associate(cuser());

    //     $model->save();
    // }
}
