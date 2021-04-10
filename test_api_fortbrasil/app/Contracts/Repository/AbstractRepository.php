<?php


namespace App\Contracts\Repository;


abstract class AbstractRepository
{
    protected $model;

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->getModel()::get();
    }

    public function store(array $request)
    {
        return $this->getModel()::create($request);
    }

    public function find(int $id)
    {
      return $this->getModel()::find($id);
    }
}
