<?php

namespace App\Http\Controllers;

use App\Models\Paymode;
use Illuminate\Http\Request;

class PaymodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymodes = Paymode::all();
        return view('paymode.index', ['paymodes' => $paymodes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paymode.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $paymode = new Paymode();
        $paymode->id = $request->id;
        $paymode->name = $request->name;
        $paymode->observation = $request->observation;
        $paymode->save();

        return redirect()->route("paymodes.index");
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
        $paymode = Paymode::find($id);
        return view('paymode.edit', ['paymode' => $paymode]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $paymode = Paymode::find($id);
        $paymode->name = $request->name;
        $paymode->observation = $request->observation;
        $paymode->save();

        $paymodes = Paymode::all();
        return view('paymode.index', ['paymodes' => $paymodes]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paymode = Paymode::find($id);
        $paymode->delete();

        $paymodes = Paymode::all();
        return view('paymode.index', ['paymodes' => $paymodes]);
    }
}
