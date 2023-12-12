<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Models\ReturnFromCustomer;

class ReturnFromCustomerController extends Controller
{

public function autocomplete(Request $request)
{
    $referenceNumbers = Sale::where('reference_no', 'like', '%' . $request->term . '%')
        ->pluck('reference_no');

    return response()->json($referenceNumbers);
}

public function getData(Request $request)
{
    $sale = Sale::where('reference_no', $request->reference_no)->first();

    if ($sale) {
        // You can modify this based on your actual database fields
        $data = [
            'customer_id' => $sale->customer->name,
            // 'product' => $sale->details->product_id,
            'sales_date' => $sale->sales_date,
            'total_quantity' => $sale->total_quantity,
            'total' => $sale->grand_total,
            'other_charge' => $sale->other_charge,
        ];

        return response()->json($data);
    }

    return response()->json(['error' => 'No data found for the given reference number']);
}







    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('return.checkCustomerPurchase');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ReturnFromCustomer $returnFromCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReturnFromCustomer $returnFromCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReturnFromCustomer $returnFromCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReturnFromCustomer $returnFromCustomer)
    {
        //
    }
}
