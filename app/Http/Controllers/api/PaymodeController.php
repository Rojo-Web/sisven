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
        $paymode = new Paymode();
        $paymode->id = $request->id;
        $paymode->name = $request->name;
        $paymode->observation = $request->observation;
        $paymode->save();
        return json_encode(['paymode' => $paymode]);
    }

    public function show(string $id)
    {
        $paymode = Paymode::find($id);
        return json_encode(['paymode' => $paymode]);
    }

    public function update(Request $request, string $id)
    {
        $paymode = Paymode::find($id);
        $paymode->id = $request->id;
        $paymode->name = $request->name;
        $paymode->observation = $request->observation;
        $paymode->save();
        return json_encode(['paymode' => $paymode]);
    }

    public function destroy(string $id)
    {
        $paymode = Paymode::find($id);
        $paymode->delete();

        $paymodes = Paymode::all();
        return json_encode(['paymodes' => $paymodes, 'success' => true]);
    }
}
