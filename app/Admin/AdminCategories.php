<?php

namespace App\Admin;

/**
 * Класс для работы с моделью Categories
 */
class AdminCategories extends Admin {

    public $modelName = 'Categories';

    public $modelNameSpace = 'App\Models\\';

    // по идее поля, которые нужно вытянуть
    public $aFields = [
        'id' => 'id',
        'title' => 'Название категории',
        'description' => 'Описание категории',
    ];

    public $aEditFields = [
        'group' => 1,
        'title' => '',
        'cls' => '',
        'items' => [
            ['field'=>'title', 'title'=>'Заголовок', 'placeholder'=>"Заголовок",  'type'=>'text' , 'required'=>false],
            ['field'=>'sname', 'title'=>'Наименование', 'placeholder'=>"Наименование", 'type'=>'text', 'required'=>false],
            ['field'=>'provider', 'default' =>'payeer', 'title'=>'Провайдер',  'type'=>'select', 'required'=>false,
                'options' => [
                    [ 'value' =>'payeer', 'text' => 'payeer'],
                    [ 'value' =>'yandex', 'text' => 'yandex'],
                    [ 'value' =>'freekassa', 'text' => 'freekassa'],
                    [ 'value' =>'robokassa', 'text' => 'robokassa'],
                    [ 'value' =>'webmoney', 'text' => 'webmoney'],
                ],],
            ['field'=>'description', 'title'=>'Описание', 'placeholder'=>"Описание",'type'=>'text','required'=>false],
        ]
    ];

    public $dbModel = null;

    public $bIsEditable = true;

    public $bIsDeletable = true;

    public function __construct() {
        parent::__construct();
    }
}
