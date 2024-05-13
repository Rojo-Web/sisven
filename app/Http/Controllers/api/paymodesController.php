<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paymode;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class paymodesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymodes = Paymode::all();
        return json_encode(['paymodes' => $paymodes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name'=> ['required'],
            'observation'=> ['required'],
        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }

        $paymode = new Paymode();
        $paymode->id = $request->id;
        $paymode->name = $request->name;
        $paymode->observation = $request->observation;
        $paymode->save();
        return json_encode(['paymode' => $paymode,'success'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paymodes = Paymode::all();
        return json_encode(['paymodes' => $paymodes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $paymode = Paymode::find($id);
        if (is_null($paymode)){
            return abort(404);
        }
        $paymode->name = $request->name;
        $paymode->observation = $request->observation;
        $paymode->save();
        return json_encode(['paymode' => $paymode,'success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paymode = Paymode::find($id);
        if (is_null($paymode)){
            return abort(404);
        }
        $paymode->delete();
        return json_encode(['paymode' => $paymode,'success'=>true]);
    }
}
