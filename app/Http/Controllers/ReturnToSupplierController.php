<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\PurchaseDetails;
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
                'purchase_date' => $purchase->purchase_date,
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

    public function create()
    {
        return view('return.checkSupplierReturn');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'ref' => 'required',
            'supName' => 'required',
            'product_id' => 'required',
            'total_quantity' => 'required|numeric|min:1',
            // Add other validation rules as needed
        ]);

        DB::beginTransaction();

        try {
            // Store data in return_to_suppliers table
            $returnToSupplier = new ReturnToSupplier;
            $returnToSupplier->supplier_id = $request->supName; // Assuming supplier_id is stored in 'supName'
            $returnToSupplier->product_id = $request->product_id;
            $returnToSupplier->returned_quantity = $request->total_quantity;
            // Add other fields as needed
            $returnToSupplier->created_by = currentUserId();
            $returnToSupplier->updated_by = currentUserId();
           if($returnToSupplier->save()) {
            // Store data in stocks table
            $stock = new Stock;
            $stock->product_id = $request->product_id;
            $stock->return_to_supplier_id = $returnToSupplier->id;
            $stock->quantity = -$request->total_quantity; // Negative quantity for return
            $stock->unit_price = $request->unit_price;
            // Add other fields as needed
            $stock->save();

            DB::commit();
           }

            

            return response()->json(['success' => 'Data stored successfully']);
        } catch (\Exception $e) {
            DB::rollBack();

            // Handle the exception (e.g., log the error)
            return response()->json(['error' => 'Error storing data']);
        }
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
