<?php

namespace App\Admin;

class AdminProductModels extends Admin
{
    public $modelName = 'ProductModels';

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
}
