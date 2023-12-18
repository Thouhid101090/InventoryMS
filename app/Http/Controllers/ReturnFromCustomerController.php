<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SalesDetails;
use App\Models\Product;
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
        $products=array();
        foreach($sale->details as $sd){
            $product=Product::find($sd->product_id);
            $products[]=array('quantity'=>$sd->quantity,'unit_price'=>$sd->unit_price,'id'=>$product->id,'product_name'=>$product->product_name);
        }

        $data = [
            'customer_id' => $sale->customer->name,
            'sales_date' => $sale->sales_date,
            'products' => $products
        ];
        return response()->json($data);

    }
    return response()->json(['error' => 'No data found for the given reference number']);
}

    public function index()
     {

      }

    public function create()
    {
        return view('return.checkCustomerPurchase');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }
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
