<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = categorie::all();
        return json_encode(['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Error al Validar la Informacion',
                'statusCode' => 400
            ]);
        }
        $categorie = new categorie();
        $categorie->name = $request->name;
        $categorie->description = $request->description;
        $categorie->id = $request->id;
        $categorie->save();
        return json_encode(['categorie' => $categorie, 'success' => true]);
    }

    public function show(string $id)
    {
        $categorie = categorie::find($id);
        if (is_null($categorie)) {
            return abort(404);
        }
        return json_encode(['categorie' => $categorie]);
    }

    public function update(Request $request, string $id)
    {
        $categorie = categorie::find($id);
        if (is_null($categorie)) {
            return abort(404);
        }
        $categorie->name = $request->name;
        $categorie->description = $request->description;
        $categorie->save();
        return json_encode(['categorie' => $categorie, 'success' => true]);
    }

    public function destroy(string $id)
    {
        $categorie = categorie::find($id);
        if (is_null($categorie)) {
            return abort(404);
        }
        $categorie = categorie::find($id);
        $categorie->delete();
        return json_encode(['categorie' => $categorie, 'success' => true]);
    }
}
