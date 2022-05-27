<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogCategoryRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Get all categories with paginate
     *
     * @param  int|null  $perPage
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getAllWithPaginate(int $perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startCondition()
            ->select($columns)
            ->paginate(15);

        return $result;
    }

    /**
     * Get model for edit
     *
     * @param  int  $id
     *
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startCondition()->find($id);
    }

    /**
     * Get category list for show in select box
     *
     * @return Collection
     */
    public function getComboBox()
    {
        $columns = ['id', 'title'];

        $result = $this
            ->startCondition()
            ->toBase()
            ->get($columns);

        return $result;
    }
}