<?php
namespace App\VueTables;
use Carbon\Carbon;

class EloquentVueTables implements VueTablesInterface
{
    public function get($model, array $fields, array $relations = [])
    {
        $byColumn = request('byColumn');
        $limit = request('limit');
        $orderBy = request('orderBy');
        $page = request('page');
        $ascending = request('ascending');
        $query = json_decode(request('query'));
        $data = $model->select($fields)->with($relations);
        if (request('sucursal_id')) {
            $data->where('sucursal_id',request('sucursal_id'));
        }
        if (isset($query) && $query) {
            $data = $byColumn == 1 ?
                $this->filterByColumn($data, $query) :
                $this->filter($data, $query, $fields);
        }
        $count = $data->count();
        $data->limit($limit)
            ->skip($limit * ($page - 1));
        if (isset($orderBy)) {
            $direction = $ascending == 1 ? 'ASC' : 'DESC';
            $data->orderBy($orderBy, $direction);
        }
        $results = $data->get()->toArray();
        return [
            'data' => $results,
            'count' => $count,
        ];
    }
    protected function filterByColumn($data, $queries)
    {
        return $data->where(function ($q) use ($queries) {
            foreach ($queries as $field => $query) {
                if (is_string($query) && $field !== "sucursal_id") {
                    $q->where($field, 'LIKE', "%{$query}%");
                } else {
                    $start = Carbon::createFromFormat('Y-m-d', $query['start'])->startOfDay();
                    $end = Carbon::createFromFormat('Y-m-d', $query['end'])->endOfDay();
                    $q->whereBetween($field, [$start, $end]);
                }
            }
        });
    }
    protected function filter($data, $query, $fields)
    {
        return $data->where(function ($q) use ($query, $fields) {
            foreach ($fields as $index => $field) {
                $method = $index ? 'orWhere' : 'where';
                $q->{$method}($field, 'LIKE', "%{$query}%");
            }
        });
    }
}