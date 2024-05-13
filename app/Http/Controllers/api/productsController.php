<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use \Illuminate\Support\Facades\Validator;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = DB::table('Products')
            ->join('Categories', 'Products.category_id', '=', 'Categories.id')
            ->select('Products.*', "Categories.name as nameC")->get();
            return json_encode(['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name'=> ['required'],
            'price'=> ['required'],
            'stock'=> ['required'],
            'category_id'=> ['required'],

        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $product = new product();
        $product->name = $request->name;
        $product->price = intval($request->price);
        $product->stock = intval($request->stock);
        $product->category_id = $request->category_id;
        $product->id = $request->id;
        $product->save();
        return json_encode(['product' => $product,'success'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = product::find($id);
        if (is_null($product)){
            return abort(404);
        }
        $product = product::find($id);
        $categories = DB::table('categories')
            ->orderBy('name')
            ->get();
        return json_encode(['product' => $product,"categories" => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = product::find($id);
        if (is_null($product)){
            return abort(404);
        }
        $product = product::find($id);
        $product->name = $request->name;
        $product->price = intval($request->price);
        $product->stock = intval($request->stock);
        $product->category_id = $request->category_id;
        $product->save();
        return json_encode(['product' => $product,'success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = product::find($id);
        if (is_null($product)){
            return abort(404);
        }
        $product = product::find($id);
        $product->delete();
        return json_encode(['product' => $product,'success'=>true]);
    }
}
