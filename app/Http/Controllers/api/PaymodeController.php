<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Paymode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymodeController extends Controller
{
    public function index()
    {
        $paymodes = Paymode::all();
        return json_encode(['paymodes' => $paymodes]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required'],
            'observation' => ['required'],
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Error al validar la informacion',
                'statusCode' => 400
            ]);
        }

        $paymode = new Paymode();
        $paymode->id = $request->id;
        $paymode->name = $request->name;
        $paymode->observation = $request->observation;
        $paymode->save();
        return json_encode(['paymode' => $paymode, 'success' => true]);
    }

    public function show(string $id)
    {
        $paymodes = Paymode::all();
        return json_encode(['paymodes' => $paymodes]);
    }

    public function update(Request $request, string $id)
    {
        $paymode = Paymode::find($id);
        if (is_null($paymode)) {
            return abort(404);
        }
        $paymode->name = $request->name;
        $paymode->observation = $request->observation;
        $paymode->save();
        return json_encode(['paymode' => $paymode, 'success' => true]);
    }

    public function destroy(string $id)
    {
        $paymode = Paymode::find($id);
        if (is_null($paymode)) {
            return abort(404);
        }
        $paymode->delete();
        return json_encode(['paymode' => $paymode, 'success' => true]);
    }
}
