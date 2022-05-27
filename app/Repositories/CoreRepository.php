<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 *  Repository of work with essence (сутністю)
 *  Can return data sets
 *  Can't create/edit essence
 */
abstract class CoreRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * CoreRepository constructor
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return Model|mixed
     */
    protected function startCondition()
    {
        return clone $this->model;
    }
}