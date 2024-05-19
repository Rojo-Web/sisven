<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class invoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = DB::table('invoices')
            ->join('_customers', 'invoices.customer_id', '=', '_customers.document_number')
            ->join('pay_mode', 'invoices.pay_mode_id', '=', 'pay_mode.id')
            ->select('invoices.*', '_customers.first_name as customer_name', 'pay_mode.name as paymode_name', '_customers.last_name as customer_last_name')
            ->get();
            return json_encode(['invoices' => $invoices]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'number'=> ['required'],
            'customer_id'=> ['required'],
            'date'=> ['required'],
            'pay_mode_id'=> ['required'],
        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }

        // Validar los datos del formulario
        $invoice = new Invoice();
        $invoice->number = intval($request->number);
        $invoice->customer_id = $request->customer_id;
        $invoice->date = $request->date;
        $invoice->pay_mode_id = $request->pay_mode_id;
        $invoice->save();
        return json_encode(['invoice' => $invoice,'success'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $invoices = Invoice::table('invoices')
        // ->join('_customers', 'invoices.customer_id', '=', '_customers.id')
        // ->join('pay_mode', 'invoices.pay_mode_id', '=', 'pay_mode.id')
        // ->select('invoices.*', '_customers.first_name as customer_name', 'pay_mode.name as paymode_name', '_customers.last_name as customer_last_name')
        // ->get();
        // return json_encode(['invoices' => $invoices]);

        $invoice = Invoice::find($id);
        if (is_null($invoice)){
            return abort(404);
        }

        $customers = DB::table('_customers')
            ->orderBy('document_number')
            ->get();
        $paymodes = DB::table('pay_mode')
            ->orderBy('name')
            ->get();
        return json_encode(['invoice' => $invoice,"customers" => $customers,"paymodes" => $paymodes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = Invoice::find($id);
        if (is_null($invoice)){
            return abort(404);
        }
        $invoice->number = $request->number;
        $invoice->customer_id = $request->customer_id;
        $invoice->date = date("Y-m-d H:i:s");
        $invoice->pay_mode_id = $request->pay_mode_id;
        $invoice->save();
        return json_encode(['invoice' => $invoice,'success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = Invoice::find($id);
        if (is_null($invoice)){
            return abort(404);
        }
        $invoice->delete();
        return json_encode(['invoice' => $invoice,'success'=>true]);
    }
}
