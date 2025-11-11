<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 * @package App\Repositories
 */
class BaseRepository
{
    protected $model;

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function pagination(
        array $column = ['*'], 
        array $condition = [], 
        int $perPage = 20,
        array $extend = [],
        array $orderBy = ['id', 'DESC'],
        array $join = [],
        array $relations = [],
        array $rawQuery = []
    ){
        $query = $this->model->select($column);
        // Loại bỏ các hàm customJoin, customGroupBy, customOrderBy để tránh lỗi truy vấn liên quan đến tb2.canonical
        return $query
            ->keyword($condition['keyword'] ?? null)
            ->publish($condition['publish'] ?? null)
            ->relationCount($relations ?? null)
            ->customWhere($condition['where'] ?? null)
            ->customWhereRaw($rawQuery['whereRaw'] ?? null)
            // ->customJoin($join ?? null)
            // ->customGroupBy($extend['groupBy'] ?? null)
            // ->customOrderBy($orderBy ?? null)
            ->paginate($perPage)
            ->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }
}
