<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\customer;
use App\Models\Paymode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = DB::table('invoices')
            ->join('_customers', 'invoices.customer_id', '=', '_customers.id')
            ->join('pay_mode', 'invoices.pay_mode_id', '=', 'pay_mode.id')
            ->select('invoices.*', '_customers.first_name as customer_name', 'pay_mode.name as paymode_name', '_customers.last_name as customer_last_name')
            ->get();
        return view('invoice.index', ['invoices' => $invoices]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = DB::table('_customers')
            ->orderBy('first_name')
            ->get();

        $paymodes = DB::table('pay_mode')
            ->orderBy('name')
            ->get();

        return view('invoice.new', ['customers' => $customers, 'paymodes' => $paymodes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $invoice = new Invoice();
        $invoice->number = $request->number;
        $invoice->customer_id = $request->customer_id;
        $invoice->date = date("Y-m-d H:i:s");
        $invoice->pay_mode_id = $request->pay_mode_id;
        $invoice->save();

        $invoices = DB::table('invoices')
            ->join('_customers', 'invoices.customer_id', '=', '_customers.id')
            ->join('pay_mode', 'invoices.pay_mode_id', '=', 'pay_mode.id')
            ->select('invoices.*', '_customers.first_name as customer_name', 'pay_mode.name as paymode_name', '_customers.last_name as customer_last_name')
            ->get();
        return view('invoice.index', ['invoices' => $invoices]);
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
        $invoice = Invoice::find($id);

        $customers = DB::table('_customers')
            ->orderBy('first_name')
            ->get();

        $paymodes = DB::table('pay_mode')
            ->orderBy('name')
            ->get();

        return view('invoice.edit', ['invoice' => $invoice, 'customers' => $customers, 'paymodes' => $paymodes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = Invoice::find($id);
        $invoice->number = $request->number;
        $invoice->customer_id = $request->customer_id;
        $invoice->date = date("Y-m-d H:i:s");
        $invoice->pay_mode_id = $request->pay_mode_id;
        $invoice->save();

        $invoices = DB::table('invoices')
            ->join('_customers', 'invoices.customer_id', '=', '_customers.id')
            ->join('pay_mode', 'invoices.pay_mode_id', '=', 'pay_mode.id')
            ->select('invoices.*', '_customers.first_name as customer_name', 'pay_mode.name as paymode_name', '_customers.last_name as customer_last_name')
            ->get();
        return view('invoice.index', ['invoices' => $invoices]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();

        $invoices = DB::table('invoices')
            ->join('_customers', 'invoices.customer_id', '=', '_customers.id')
            ->join('pay_mode', 'invoices.pay_mode_id', '=', 'pay_mode.id')
            ->select('invoices.*', '_customers.first_name as customer_name', 'pay_mode.name as paymode_name', '_customers.last_name as customer_last_name')
            ->get();
        return view('invoice.index', ['invoices' => $invoices]);
    }
}
