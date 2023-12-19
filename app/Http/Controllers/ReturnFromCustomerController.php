<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SalesDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ReturnFromCustomer;
use Excepsion;
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
    // Fetch all return transactions from customers
    $returnFromCustomers = ReturnFromCustomer::with('customer', 'salesDetails.product')->get();

    // Pass the data to the view
    return view('return.ReturnFromCustomer.index', compact('returnFromCustomers'));
}

    public function create()
    {
        return view('return.ReturnFromCustomer.checkCustomerPurchase');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     
            try {
                $request->validate([
                    'customer_id' => 'required',
                    'sales_date' => 'required|date',
                    'product_id' => 'required',
                    'total_quantity' => 'required|numeric|min:1',
                    'unit_price' => 'required|numeric|min:0',
                    'total' => 'required|numeric|min:0',
                ]);
        
                // Create a new ReturnFromCustomer instance
                $returnFromCustomer = new ReturnFromCustomer();
                $returnFromCustomer->customer_id = $request->customer_id;
                $returnFromCustomer->sales_date = $request->sales_date;
        
                // Save the ReturnFromCustomer instance to get the ID
                $returnFromCustomer->save();
        
                // Create a new SalesDetails instance for each returned product
                $salesDetails = new SalesDetails();
                $salesDetails->return_from_customer_id = $returnFromCustomer->id;
                $salesDetails->product_id = $request->product_id;
                $salesDetails->quantity = $request->total_quantity;
                $salesDetails->unit_price = $request->unit_price;
                $salesDetails->total = $request->total;
                $salesDetails->save();
        
                // You can add more logic to handle multiple returned products
        
                // Optionally, you can redirect the user after storing the data
                return redirect()->route('return.index')->with('success', 'Return from customer stored successfully.');
            
            } catch (\Throwable $e) {
                dd($e);
            }
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
