<?php

namespace App\Admin;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class AdminProducts extends Admin
{
    public $modelName = 'Products';

    public $modelNameSpace = 'App\Models\\';

    // по идее поля, которые нужно вытянуть
    public $aFields = [
        'id' => 'id',
        'title' => 'Название категории',
        'description' => 'Описание категории',
    ];

    public $dbModel = null;

    public $bIsEditable = true;

    public $bIsDeletable = true;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Добавление элемента
     * @param Request $request
     * @return JsonResponse
     */
    public function postCreate(Request $request) {

        $files = $request->file('files');
        $data = $request->input();
        $images = [];

        foreach ($files as $file) {
            $name = time()."_".$file->getClientOriginalName();
            $path = base_path().'/public/images/products';
            $file->move($path, $name);
            array_push($images, $name);
        }
        $data['images'] = json_encode($images);

        $response = array_filter($data, function($key) {
            if (in_array($key, $this->aColumns)) {
                return $key;
            }
        }, ARRAY_FILTER_USE_KEY);

        $data = $this->dbModel->create($response);
        $data['images'] = $images;

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }

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

        foreach ($data as $product) {
            $product['images'] = json_decode($product['images']);
        }

        return response()->json([
            'count' => $count,
            'data' => $data,
            'fields' => $this->aFields
        ]);
    }
}
