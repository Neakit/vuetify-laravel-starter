<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminModelService
{
   /**
    * Класс для работы с одной конкретной моделью в админке
    */

    protected $model = ''; // categories
    protected $oModel; // 'App\Admin\AdminCategories'
    protected $aFields = []; // поля таблицы
    protected $dbModel; // елоквент модель

    /**
     * Получение необходимых полей
     * @param string $model
     */
    public function __construct($model){
        $model = Str::camel($model);
        $this->model = $model;
        if ($model != '') {
            $sModelName = "App\Admin\Admin" . ucfirst($model); // 'App\\Admin\\AdminCategories'
            $this->oModel = new $sModelName(); // AdminCategories instance
            $this->dbModel = $this->oModel->dbModel;

            if ($this->dbModel) {
                $this->aFields = $this->oModel->aFields;
            }
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
//    public function getDisplay(){
//        return view('admin',['page'=>$this->model, 'action'=>'list'])
//            ->with('aFields', $this->aFields);
//    }

    /**
     * Сохранение отредактированных полей
     * @param Request $request
     * @param string $nId
     * @return array
     */
    public function postSave(Request $request,  $nId){
        return $this->oModel->postSave($request, $nId);
    }

    /**
     * Добавление элемента
     * @param Request $request
     * @return array
     */
//    public function postCreate(Request $request){
//        return $this->oModel->postCreate($request);
//    }

    /**
     * Получение массива данных по одному элементу из моделей для вывода в таблицах
     * @param string $id
     * @return array
     */
//    public function getRecord($id){
//        return $this->oModel->getRecord($id);
//    }

    /**
     * Получение массива данных из моделей для вывода в таблицах
     * @param Request $request
     * @return array
     */
    public function getRecords(Request $request) {

        return ($this->dbModel) ? $this->oModel->getRecordsWithParams($request->all()) : [];
    }

    /**
     * Получение полей для редактирования
     * @return array
     */
//    public function getEditFields(){
//        return  $this->oModel->aEditFields;
//    }
}
