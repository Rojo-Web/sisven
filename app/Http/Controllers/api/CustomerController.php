<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = customer::all();
        return response()->json(['customers' => $customers], 200, [], JSON_PRETTY_PRINT);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document_number' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'address' => ['required'],
            'birthday' => ['required'],
            'phone_number' => ['required'],
            'email' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => 'Se produjo un error'
            ], 400);
        }

        $customer = new customer();
        $customer->document_number = $request->document_number;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->address = $request->address;
        $customer->birthday = $request->birthday;
        $customer->phone_number = $request->telephone_numberfono;
        $customer->id = $request->id;
        $customer->email = $request->email;
        $customer->save();

        $customers = Customer::all();
        return response()->json(['customers' => $customers], 200, [], JSON_PRETTY_PRINT);
    }

    public function show(string $id)
    {
        $customer = Customer::find($id);

        if (is_null($customer)) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        return response()->json(['customer' => $customer], 200, [], JSON_PRETTY_PRINT);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'document_number' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'address' => ['required'],
            'birthday' => ['required'],
            'phone_number' => ['required'],
            'email' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        $customer->document_number = $request->document_number;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->address = $request->address;
        $customer->birthday = $request->birthday;
        $customer->phone_number = $request->telephone_numberfono;
        $customer->email = $request->email;
        $customer->save();

        return response()->json(['customers' => $customer], 200, [], JSON_PRETTY_PRINT);
    }

    public function destroy(string $id)
    {
        $customer = customer::find($id);
        $customer->delete();

        $customers = customer::all();
        return response()->json(['customers' => $customers, 'success' => true], 200, [], JSON_PRETTY_PRINT);
    }
}
