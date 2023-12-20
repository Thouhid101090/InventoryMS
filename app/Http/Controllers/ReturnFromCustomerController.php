<?php

namespace App\Http\Controllers;

use DB;
use Excepsion;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SalesDetails;
use Illuminate\Http\Request;
use App\Models\ReturnFromCustomer;

class ReturnFromCustomerController extends Controller {

    public function autocomplete( Request $request ) {
        $referenceNumbers = Sale::where( 'reference_no', 'like', '%' . $request->term . '%' )
        ->pluck( 'reference_no' );
        return response()->json( $referenceNumbers );
    }

    public function getData( Request $request ) {
        $sale = Sale::where( 'reference_no', $request->reference_no )->first();

        if ( $sale ) {
            $products = array();
            foreach ( $sale->details as $sd ) {
                $product = Product::find( $sd->product_id );
                $products[] = array( 'quantity'=>$sd->quantity, 
                'unit_price'=>$sd->unit_price, 
                'id'=>$product->id, 
                'product_name'=>$product->product_name,
                'product_id'=>$sd->product_id
             );
            }

            $data = [
                'customer_id' => $sale->customer->id,
                'customer_name' => $sale->customer->name,
                'sales_date' => $sale->sales_date,
                'products' => $products,
                
               
            ];
            return response()->json( $data );

        }
        return response()->json( [ 'error' => 'No data found for the given reference number' ] );
    }

    public function index() {
        {
           
                $returnFromCustomers = ReturnFromCustomer::all();
                return view('return.ReturnFromCustomer.index', compact('returnFromCustomers'));
            
            
        }
    }

    public function create() {
        $customer = new Customer;
        // $product = new Product;
        // $sale = new Sale;
        $saleDetails = new SalesDetails;
        return view( 'return.ReturnFromCustomer.checkCustomerPurchase', compact( 'customer', 'saleDetails' ) );
    }

    public function store( Request $request ) {

        DB::beginTransaction();
        try {
            $r = new ReturnFromCustomer;
            $r->ref_no = $request->ref;
            $r->customer_id = $request->cust;
            $r->product_id = $request->pro;
            $r->sales_date = $request->sal_dt;
            $r->returned_quantity = $request->ttl_qty;
            $r->total_amount = $request->ttl_prs;
            // dd( $request->all() );
            $r->save();
            DB::commit();
            return redirect()->route( 'return.index' )->with( 'success', 'Return from customer stored successfully.' );

        } catch ( \Throwable $e ) {
            DB::rollback();
            dd( $e );
        }
    }

    public function show( ReturnFromCustomer $returnFromCustomer ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( ReturnFromCustomer $returnFromCustomer ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, ReturnFromCustomer $returnFromCustomer ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( ReturnFromCustomer $returnFromCustomer ) {
        //
    }
}
