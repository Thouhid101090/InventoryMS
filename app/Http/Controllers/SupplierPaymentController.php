<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\SupplierPayment;

class SupplierPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row',10);
        if($row<1 || $row>100){
            abort(400,'The per-page parameter must be integer between 1 to 100.');

        }

        $supplierPayment = SupplierPayment::with(['supplier'])
        ->paginate($row)
        ->appends(request()->query());
        return view('supplierPayment.index',compact('supplierPayment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
       return view('supplierPayment.create',compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $supplierPayment=new SupplierPayment;
        $supplierPayment->supplier_id=$request->supName;
        $supplierPayment->pay_date=$request->date;
        $supplierPayment->amount=$request->pay;
        $supplierPayment->created_by=currentUserId();
        $supplierPayment->save();
        return redirect()->route('supplierPayment.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(SupplierPayment $supplierPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $suppliers = Supplier::find($id);
        $supplierPayment = SupplierPayment::find($id);
    
        // Check if records are found
        if (!$suppliers || !$supplierPayment) {
            // Handle the case when the records are not found
            abort(404); // or redirect, show an error page, etc.
        }
    
        return view('supplierPayment.edit', compact('suppliers', 'supplierPayment'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id )
    {
        $suppliers = Supplier::find($id);
        $supplierPayment=SupplierPayment::find($id);
        $supplierPayment->supplier_id=$request->supName;
        $supplierPayment->pay_date=$request->date;
        $supplierPayment->amount=$request->pay;
        $supplierPayment->created_by=currentUserId();
        $supplierPayment->save();
        return redirect()->route('supplierPayment.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierPayment $supplierPayment)
    {
        //
    }
}
