<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\categorie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = categorie::all();
        return json_encode(['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $category = new categorie();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->id = $request->id;
        $category->save();
        return json_encode(['category' => $category]);
    }

    public function show(string $id)
    {
        $category = categorie::find($id);
        return json_encode(['category' => $category]);
    }

    public function update(Request $request, string $id)
    {
        $category = categorie::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->id = $request->id;
        $category->save();
        return json_encode(['category' => $category]);
    }

    public function destroy(string $id)
    {
        $category = categorie::find($id);
        $category->delete();

        $categories = categorie::all();
        return json_encode(['categories' => $categories, 'success' => true]);
    }
}
