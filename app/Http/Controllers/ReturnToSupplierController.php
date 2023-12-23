<?php

namespace App\Http\Controllers;
use DB;
use Exception;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\PurchaseDetails;
use App\Models\ReturnToSupplier;

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
                $products[]=array('quantity'=>$sd->quantity,
                'unit_price'=>$sd->unit_price,
                'id'=>$product->id,
                'product_name'=>$product->product_name,
                'product_id'=>$sd->product_id
            );
            }

            $data = [
                'supplier_id' => $purchase->supplier->id,
                'supplier_name' => $purchase->supplier->name,
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
        $ReturnToSupplier = ReturnToSupplier::all();
        return view('Return.ReturnToSupplier.index', compact('ReturnToSupplier'));
    }

    public function create()
    {
        $supplier = new Supplier;
        $purDetails = new purchaseDetails;
        return view( 'Return.ReturnToSupplier.checkSupplierReturn',
         compact( 'supplier', 'purDetails' ) );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $r = new ReturnToSupplier;
            $r->ref_no = $request->ref;
            $r->supplier_id = $request->sup_id;
            $r->product_id = $request->pro;
            $r->purchase_date = $request->pur_dt;
            $r->returned_quantity = $request->ttl_qty;
            $r->total_amount = $request->ttl_prs;
            // dd( $request->all() );
            $r->save();

            $stock = Stock::where('product_id', $request->pro)->first();
        if ($stock) {
            // Update existing stock
            $stock->quantity -= $request->ttl_qty;
            $stock->return_to_supplier_id = $r->id;
            $stock->save();
        } else {
            // Create a new stock entry
            Stock::create([
                'product_id' => $request->pro,
                'quantity' => $request->ttl_qty,
                'return_from_customer_id' => $r->id,
                // Add other necessary fields.
            ]);
        }
            DB::commit();
            return redirect()->route( 'supplierReturn.index' )->with( 'success', 'Return from customer stored successfully.' );

        } catch ( \Throwable $e ) {
            DB::rollback();
            dd( $e );
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
