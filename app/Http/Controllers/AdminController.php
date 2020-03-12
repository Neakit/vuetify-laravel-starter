<?php

namespace App\Http\Controllers;

use App\Services\AdminModelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    /**
     * @param Request $request
     * @return false|string
     */
    public function authAdmin(Request $request)
    {
        $adminUser = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 100
        ];

        if (Auth::attempt($adminUser)) {
            return json_encode(['success' => true, 'code' => 200, 'url' => '/admin/dashboard']);
        } else {
            return json_encode(['success' => false, 'code' => 401]);
        }
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function logoutAdmin(Request $request) {
        Auth::logout();
        return json_encode(['success' => true, 'code' => 200, 'message' => 'successfully logout']);
    }

    /**
     * Получение массива данных из моделей для вывода в таблицах
     * @param Request $request
     * @param string $model
     * @return array
     */
    public function getRecords(Request $request, $model)
    {
        return (new AdminModelService($model))->getRecords($request);
    }

    /**
     * Сохранение отредактированных полей
     * @param Request $request
     * @param string $model
     * @param string $nId
     * @return array
     */
    public function postSave(Request $request, $model, $nId)
    {
        return (new AdminModelService($model))->postSave($request, $nId);
    }

    /**
     * Добавление элемента
     * @param Request $request
     * @param string $model
     * @return array
     */
    public function postCreate(Request $request, $model)
    {
        return (new AdminModelService($model))->postCreate($request);
    }

    /**
     * Удаление элемента
     * @param Request $request
     * @param string $model
     * @param string $nId
     * @return array
     */
    public function postDelete(Request $request, $model, $nId)
    {
        return (new AdminModelService($model))->postDelete($request, $nId);
    }

}
