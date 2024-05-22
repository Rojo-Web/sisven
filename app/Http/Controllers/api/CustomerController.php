<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = customer::all();
        return json_encode(['customers' => $customers]);
    }

    public function store(Request $request)
    {
        $customer = new customer();
        $customer->document_number = $request->document_number;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->address = $request->address;
        $customer->birthday = $request->birthday;
        $customer->phone_number = $request->phone_number;
        $customer->id = $request->id;
        $customer->email = $request->email;
        $customer->save();

        return json_encode(['customer' => $customer]);
    }

    public function show(string $id)
    {
        $customer = Customer::find($id);

        return json_encode(['customer' => $customer]);
    }

    public function update(Request $request, string $id)
    {
        $customer = customer::find($id);
        $customer->document_number = $request->document_number;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->address = $request->address;
        $customer->birthday = $request->birthday;
        $customer->phone_number = $request->phone_number;
        $customer->id = $request->id;
        $customer->email = $request->email;
        $customer->save();

        return json_encode(['customer' => $customer]);
    }

    public function destroy(string $id)
    {
        $customer = customer::find($id);
        $customer->delete();

        $customers = customer::all();
        return json_encode(['customers' => $customers, 'success' => true]);
    }
}
