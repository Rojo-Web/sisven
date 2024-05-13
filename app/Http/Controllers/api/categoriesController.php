<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categorie;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class categoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = categorie::all();
        return json_encode(['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name'=> ['required'],
            'description'=> ['required'],
        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $categorie = new categorie();
        $categorie->name = $request->name;
        $categorie->description = $request->description;
        $categorie->id = $request->id;
        $categorie->save();
        return json_encode(['categorie' => $categorie,'success'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categorie = categorie::find($id);
        if (is_null($categorie)){
            return abort(404);
        }
        return json_encode(['categorie' => $categorie]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categorie = categorie::find($id);
        if (is_null($categorie)){
            return abort(404);
        }
        $categorie->name = $request->name;
        $categorie->description = $request->description;
        $categorie->save();
        return json_encode(['categorie' => $categorie,'success'=>true]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categorie = categorie::find($id);
        if (is_null($categorie)){
            return abort(404);
        }
        $categorie = categorie::find($id);
        $categorie->delete();
        return json_encode(['categorie' => $categorie,'success'=>true]);
    }
}
