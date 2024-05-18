<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Log;

abstract class BaseModelService
{
    protected $model;
    protected $allow_all_records = false;
    public function __construct($model)
    {
        $this->model = $model;
    }

    // get results of model
    public function get($relations = [], $params = ['*'], $conditions = [], $order = [], $paginate = 10, $filters = [])
    {
        $query = $this->model::query()->with($relations)->select($params);

        $query = $this->applyCondtions($query, $conditions);
        $query = $this->applyFilters($query, $filters);

        if (count($order) == 2) {
            [$order_field, $dir] = array_values($order);
            $query->orderBy($order_field, $dir);
        }

        if ($this->getAllowAllRecords() && $paginate == 0) {
            return $query->get();
        }

        $paginate = checkPagiantion($paginate);
        return $query->paginate($paginate);
    }


    // get results based conditions passed
    // for example conditions=[['name','=','value']] & etc
    protected function applyCondtions($query, $conditions)
    {
        foreach ($conditions as $condition) {
            if (count($condition) == 3) {
                [$column, $operator, $value] = $condition;
                $query->where($column, $operator, $value);
            }
        }
        return $query;
    }

    // get results based the filters passed & is defined by scopes in model
    // for example  filters=['name'] & etc
    protected function applyFilters($query, $filters = [])
    {
        foreach ($filters as $filter => $value) {
            $scope_method = 'scope' . ucfirst($filter);
            if (method_exists($this->model, $scope_method)) {
                $query->$filter($value);
            }
        }
        return $query;
    }

    // find model by id
    public function find($id, $relations = [], $params = ['*'], $conditions = [])
    {
        $query = $this->model::query()->with($relations)->select($params);
        foreach ($conditions as $condition) {
            if (count($condition) == 3) {
                [$column, $operator, $value] = $condition;
                $query->where($column, $operator, $value);
            }
        }
        return $query->findOrFail($id);
    }

    // create model
    public function create(Request $request)
    {
        $data = $this->getModelAttributes($request);
        try {
            $model = $this->model->create($data);
        } catch (Throwable $e) {
            Log::error("Fail with Creation in Model : " . get_class($this) . " erorr:" . $e->getMessage());
            return generateApiResoponse(false, 500, message: __('response.faild_created'));
        }
        return generateApiResoponse(true, 200, data: $model, message: __('response.success_created'));
    }

    // get the fillable attributes in the model
    protected abstract function getModelAttributes($request);

    public function update($id, $request)
    {
        try {
            $model = $this->find($id);
            $data = $this->getModelAttributes($request);
            $model->update($data);
        } catch (Throwable $e) {
            Log::error("Fail with Updated in Model : " . get_class($this) . " erorr:" . $e->getMessage());
            return generateApiResoponse(false, 500, message: __('response.faild_updated'));
        }
        return generateApiResoponse(true, 200, message: __('response.success_updated'), data: $model);
    }

    // delete model by id
    public function delete($id)
    {
        try {
            $model = $this->find($id);
            $model->delete();
        } catch (Throwable $e) {
            Log::error("Fail with Deleted in Model : " . get_class($this) . " erorr:" . $e->getMessage());
            return generateApiResoponse(false, 500, message: __('response.faild_delete'));
        }
        return generateApiResoponse(true, 200, message: __('response.success_delete'));
    }

    public function getAllowAllRecords()
    {
        return $this->allow_all_records;
    }
}
