<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\details;

use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class detailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = DB::table('_details')
            ->join('invoices', '_details.invoice_id', '=', 'invoices.id')
            ->join('products', '_details.product_id', '=', 'products.id')
            ->select('_details.*', 'invoices.number as invoices_number','invoices.date as invoices_date', 'products.name as products_name', 'products.price as products_price', 'products.stock as products_stock')
            ->get();
            return json_encode(['details' => $details]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'invoice_id'=> ['required'],
            'product_id'=> ['required'],
            'quantity'=> ['required'],
            'price'=> ['required'],
        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }

        // Validar los datos del formulario
        $detail = new details();
        $detail->invoice_id = $request->invoice_id;
        $detail->product_id = $request->product_id;
        $detail->quantity = intval($request->quantity);
        $detail->price = intval($request->price);
        $detail->save();
        return json_encode(['detail' => $detail,'success'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $details = details::find($id);
        if (is_null($details)){
            return abort(404);
        }

        $products = DB::table('products')
            ->orderBy('name')
            ->get();
        $invoices = DB::table('invoices')
            ->orderBy('number')
            ->get();
        return json_encode(['detail' => $details,"products" => $products,"invoices" => $invoices]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $detail = details::find($id);
        if (is_null($detail)){
            return abort(404);
        }
        $detail->invoice_id = $request->invoice_id;
        $detail->product_id = $request->product_id;
        $detail->quantity = $request->quantity;
        $detail->price = $request->price;
        $detail->save();
        return json_encode(['detail' => $detail,'success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detail = details::find($id);
        if (is_null($detail)){
            return abort(404);
        }
        $detail->delete();
        return json_encode(['detail' => $detail,'success'=>true]);
    }
}
