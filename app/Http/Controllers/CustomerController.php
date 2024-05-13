<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = customer::all();
        return view('customer.index',['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.new');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer = new customer();
        $customer->document_number = $request->document_number;
        $customer->first_name = $request->name;
        $customer->last_name = $request->apellido;
        $customer->address = $request->address;
        $customer->birthday = $request->fecha_nacimiento;
        $customer->phone_number = $request->telefono;
        $customer->id = $request->id;
        $customer->email = $request->email;
        $customer->save();

        $customers = customer::all();


        return redirect()->route("customers.index");
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
        $customer = customer::find($id);
        return view('customer.edit',['customer'=> $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = customer::find($id);

        $customer->document_number = $request->document_number;
        $customer->first_name = $request->name;
        $customer->last_name = $request->apellido;
        $customer->birthday = $request->fecha_nacimiento;
        $customer->address = $request->address;
        $customer->phone_number = $request->telefono;
        $customer->email = $request->email;
        // $customer->id = $request->id;
        $customer->save();


        return redirect()->route("customers.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = customer::find($id);
        $customer->delete();

        $customers = customer::all();
        return redirect()->route("customers.index");
    }
}
