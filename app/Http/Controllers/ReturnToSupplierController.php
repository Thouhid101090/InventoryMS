<?php

namespace App\Http\Controllers;

use App\Models\ReturnToSupplier;
use Illuminate\Http\Request;

class ReturnToSupplierController extends Controller
{


    public function autocompleteS(Request $request)
    {
        $referenceNumbers = Purchase::where('reference_no', 'like', '%' . $request->term . '%')
            ->pluck('reference_no');

        return response()->json($referenceNumbers);
    }

    public function getDataS(Request $request)
    {
        $purchase = Purchase::where('reference_no', $request->reference_no)->first();


        if ($purchase) {
            $products=array();
            foreach($purchase->pdetails as $sd){
                $product=Product::find($sd->product_id);
                $products[]=array('quantity'=>$sd->quantity,'unit_price'=>$sd->unit_price,'id'=>$product->id,'product_name'=>$product->product_name);
            }

            $data = [
                'supplier_id' => $purchase->supplier->name,
                'prchase_date' => $purchase->purchase_date,
                'products' => $products
            ];
            return response()->json($data);

        }
        return response()->json(['error' => 'No data found for the given reference number']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('return.checkSupplierReturn');
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
    public function show(ReturnToSupplier $returnToSupplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReturnToSupplier $returnToSupplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReturnToSupplier $returnToSupplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReturnToSupplier $returnToSupplier)
    {
        //
    }
}
