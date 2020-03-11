<?php

namespace App\Admin;

use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Schema;
/**
 * Класс для работы с моделями. Используется для вывода данных в админке.
 *
 */

class Admin {

    public $modelName = ''; // Categories

    public $modelNameSpace = 'App\Models\\';

    public $dbModel = null;

    public $aEditFields = [];

    protected $aFields = [];

    protected $aFindFields = [];

    public $aColumns = [];

    protected $cards = null;

    public function __construct() {
        $this->aFindFields = array_keys($this->aFields); // ключи полей, которые нужно прочесть ???

        if($this->modelName) {
            $sModelName = $this->modelNameSpace . $this->modelName;
            $this->dbModel = new $sModelName(); // получаем инстанс елоквент модели
            $this->aColumns = Schema::getColumnListing($this->dbModel->getTable()); // все title колонок  [ 0 => 'id', 1 => 'title' ...]
        }
    }

    /**
     * @param $aData
     * @return mixed
     *
     */
    public function prepareData($data){
        unset($data['_token']);
        dd('asd');
        return $data;
    }

    /**
     * Получение данных из моделей с параметрами
     * @param array $requestParams
     * @return JsonResponse
     */
    public function getRecordsWithParams($requestParams) {

        $skip    = Arr::get($requestParams, 'start', 1) - 1;
        $limit   = Arr::get($requestParams, 'length', null);
        $filter  = Arr::get($requestParams, 'filter', null);
        $sortRow = Arr::get($requestParams, 'sortRow', null);
        $sort    = Arr::get($requestParams, 'sort', null);

        $query = $this->dbModel;
        if ($filter != null) {
            $i = 0;
            foreach ($this->aFindFields as $field) {
                $query = ($i == 0) ? $query->where($field, 'like', '%' . $filter . '%') : $query = $query->Orwhere($field, 'like', '%' . $filter . '%');
                $i++;
            }
        }

        $query = ($sortRow != null) ? $query->orderBy($sortRow, $sort) : $query->orderBy('id');
        $count = $query->count();
        $data  = ($limit != null ) ? $query->take($limit)->skip($skip)->get() : $query->get();

        return response()->json([
            'count' => $count,
            'data' => $data,
            'fields' => $this->aFields
        ]);
    }

    /**
     * Метод для получения данных для карт
     */
    protected function getCards(){
        return $this->cards;
    }

    /**
     * Получение данных по одному элементу
     * @param int $id
     * @param string $model
     * @param object $dbModel
     * @param array $aEditFields
     * @return mixed
     *
     */
    public function getRecord($id){
        $aFields = $this->aEditFields;
        if ($this->dbModel){
            $aData['data'] = $this->dbModel->where('id',$id)->first()->toArray();
            foreach( $aFields['items'] as &$item){
                $item['value'] =  $aData['data'][$item['field']];
            }
        }
        return $aFields;
    }

    /**
     * Добавление элемента
     * @param Request $request
     * @return array
     */
    public function postCreate(Request $request){
        $aData = $this->prepareData($request->input());
        if (array_get($aData, 'email')) {
            $aData['login'] = $aData['email'];
        }
        $aRes = array_filter($aData, function($key){
            if (in_array($key, $this->aColumns)){
                return $key;
            }
        },ARRAY_FILTER_USE_KEY );
        $id = $this->dbModel->create($aRes)->id;
        return ['success'=>true, 'id' => $id];
    }

    /**
     * Сохранение отредактированных полей
     * @param Request $request
     * @param string $nId
     * @return JsonResponse
     */
    public function postSave(Request $request,  $nId) {
//        $data = $this->prepareData($request->input());
        $data = $request->input();

        $response = array_filter($data, function($key) {
            if (in_array($key, $this->aColumns)) {
                return $key;
            }
        },ARRAY_FILTER_USE_KEY );

        $model = $this->dbModel->where('id', $nId)->first();
        $model->fill($response);
        $model->save();

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

}
