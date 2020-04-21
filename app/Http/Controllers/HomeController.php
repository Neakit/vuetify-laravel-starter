<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Services\AdminModelService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Получение массива данных из моделей для вывода в таблицах
     * @param Request $request
     * @param string $model
     * @return array
     */
    public function getRecords(Request $request)
    {
        if($request->has('all')) {
            $results = Products::with(['category', 'productModel'])
                ->where('product_model_id', $request->product_model_id)
                ->get();
            return response()->json($results, 200);
        }

        $results = Products::with(['category', 'productModel'])
            ->where(function($q) use ($request){
                if(isset($request->title)){
                    $q->where('title', 'like', "%" . urldecode($request->title) . "%");
                }
            })->whereHas('category', function($q) use ($request){
                if(isset($request->category_id)){
                    $q->where('category_id', '=', $request->category_id);
                }
            })->whereHas('productModel', function($q) use ($request){
                if(isset($request->product_model_id)){
                    $q->where('product_model_id', '=', $request->product_model_id);
                }
            })->paginate(9);

        return response()->json($results, 200);
    }

    public function getRecord($id)
    {
        $results = Products::with(['category', 'productModel'])->where('id', $id )->first();
        return response()->json($results, 200);
    }
}
