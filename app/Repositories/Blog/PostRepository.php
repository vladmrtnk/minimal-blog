<?php

namespace App\Repositories\Blog;

use App\Models\Blog\Post as Model;
use App\Models\User;
use App\Repositories\CoreRepository;
use Illuminate\Contracts\Pagination\Paginator;

class PostRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     *  Get all posts with paginate
     *
     * @param int $perPage
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getAllWithPaginate(int $perPage = 15): Paginator
    {
        $columns = ['id', 'title', 'category_id', 'user_id', 'slug', 'excerpt'];

        $result = $this
            ->startCondition()
            ->with('category:id,title')
            ->select($columns)
            ->paginate($perPage);

        return $result;
    }

    /**
     * Get All posts that belongs to user with paginate
     *
     * @param \App\Models\User $user
     * @param int              $perPage
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getAllBelongsToUserWithPaginate(User $user, int $perPage = 15): Paginator
    {
        $columns = ['id', 'title', 'category_id', 'user_id', 'slug', 'excerpt'];

        $result = $this
            ->startCondition()
            ->with('category:id,title')
            ->whereBelongsTo($user)
            ->select($columns)
            ->paginate($perPage);

        return $result;
    }

    /**
     * Get model for edit
     *
     * @param  int  $id
     *
     * @return \App\Models\Blog\Post
     */
    public function getEdit(int $id): Model
    {
        return $this->startCondition()->find($id);
    }
}