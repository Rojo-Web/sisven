<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = customer::all();
        return response()->json(['customers' => $customers],200,[],JSON_PRETTY_PRINT);
        // return json_encode(['customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     */
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
            // 'id' => 'required|numeric', // Opcional: puedes validar el ID si lo consideras necesario
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => 'Se produjo un error'], 400);
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        
        if (is_null ($customer)) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
        
        return response()->json(['customer' => $customer], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
{
    $validator = Validator::make($request->all(), [
        'document_number' => 'required',
        'name' => 'required',
        'apellido' => 'required',
        'address' => 'required',
        'fecha_nacimiento' => 'required',
        'telefono' => 'required',
        'email' => 'required,'
        // 'id' => 'required|numeric', // Opcional: puedes validar el ID si lo consideras necesario
    ]);
    
     if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $customer = Customer::find($id);

    if (!$customer) {
        return response()->json(['error' => 'Customer not found'], 404);
    }

    $customer->fill($request->all());
    $customer->save();

    return response()->json(['customers' => $customer], 200, [], JSON_PRETTY_PRINT);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        //Sin hacer


        $customer = customer::find($id);
        $customer->delete();

        $customers = customer::all();
        return response()->json(['customers'=>$customers,'success'=> true], 200, [], JSON_PRETTY_PRINT);
    }
}
