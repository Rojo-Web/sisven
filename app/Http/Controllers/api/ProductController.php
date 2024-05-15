<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('Products')
            ->join('Categories', 'Products.category_id', '=', 'Categories.id')
            ->select('Products.*', "Categories.name as nameC")->get();
        return json_encode(['products' => $products]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required'],
            'price' => ['required'],
            'stock' => ['required'],
            'category_id' => ['required'],

        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Error al validar la informacion',
                'statusCode' => 400
            ]);
        }
        $product = new product();
        $product->name = $request->name;
        $product->price = intval($request->price);
        $product->stock = intval($request->stock);
        $product->category_id = $request->category_id;
        $product->id = $request->id;
        $product->save();
        return json_encode(['product' => $product, 'success' => true]);
    }

    public function show(string $id)
    {
        $product = product::find($id);
        if (is_null($product)) {
            return abort(404);
        }
        $product = product::find($id);
        $categories = DB::table('categories')
            ->orderBy('name')
            ->get();
        return json_encode(['product' => $product, "categories" => $categories]);
    }

    public function update(Request $request, string $id)
    {
        $product = product::find($id);
        if (is_null($product)) {
            return abort(404);
        }
        $product = product::find($id);
        $product->name = $request->name;
        $product->price = intval($request->price);
        $product->stock = intval($request->stock);
        $product->category_id = $request->category_id;
        $product->save();
        return json_encode(['product' => $product, 'success' => true]);
    }

    public function destroy(string $id)
    {
        $product = product::find($id);
        if (is_null($product)) {
            return abort(404);
        }
        $product = product::find($id);
        $product->delete();
        return json_encode(['product' => $product, 'success' => true]);
    }
}
