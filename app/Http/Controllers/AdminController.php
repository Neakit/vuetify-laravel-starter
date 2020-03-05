<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

}
