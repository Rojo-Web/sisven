<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('Products')
            ->join('Categories', 'Products.category_id', '=', 'Categories.id')
            ->select('Products.*', "Categories.name as Categoryname")->get();
        return json_encode(['products' => $products]);
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->id = $request->id;
        $product->save();
        return json_encode(['product' => $product]);
    }

    public function show(string $id)
    {
        $product = Product::find($id);
        $categories = DB::table('categories')
            ->orderBy('name')
            ->get();
        return json_encode(['product' => $product, "categories" => $categories]);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->save();
        return json_encode(['product' => $product]);
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();

        $products = Product::all();
        return json_encode(['products' => $products, 'success' => true]);
    }
}
