<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = DB::table('Products')
            ->join('Categories', 'Products.category_id', '=', 'Categories.id')
            ->select('Products.*', "Categories.name as nameC")->get();
        return view('product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')
            ->orderBy('name')
            ->get();
        return view('product.new', ["categories" => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new product();
        $product->name = $request->name;
        $product->price = intval($request->price);
        $product->stock = intval($request->stock);
        $product->category_id = $request->category_id;
        $product->id = $request->id;
        $product->save();
        return redirect()->route("products.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = product::find($id);
        $categories = DB::table('categories')
            ->orderBy('name')
            ->get();
        return view('product.edit', ['product' => $product, "categories" => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = product::find($id);
        $product->name = $request->name;
        $product->price = intval($request->price);
        $product->stock = intval($request->stock);
        $product->category_id = $request->category_id;
        $product->save();
        return redirect()->route("products.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = product::find($id);
        $product->delete();

        return redirect()->route("products.index");
    }
}
