<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreRepository
 *
 * @package App\Repositories
 *
 * Репозиторий работы с сущностю.
 * Может Выдавать наборы данных.
 * не может создать/изменить сущности.
 */
abstract class CoreRepository
{
    /**
     * @var Model
     */
    protected $model;
    /**
     * CoreRepository constructor.
     */
    public function  __construct()
    {
    $this->model = app($this->getModelClass());
    }
    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return Model|\Illuminate\Foundation\Application|mixed
     */
        protected function startConditions()
        {
            return clone $this->model;
        }
}