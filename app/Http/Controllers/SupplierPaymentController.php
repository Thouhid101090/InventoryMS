<?php

namespace App\Http\Controllers;

use App\Models\SupplierPayment;
use Illuminate\Http\Request;

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

        $supplierPayment = SupplierPayment::with(['purchase','sale'])
        ->filter(request(['search']))
        ->paginate($row)
        ->appends(request()->query());
        return view('supplierPayment.index',compact('supplierPayment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplierPayment=new SupplierPayment;
        $supplierPayment->supplier_id=$request->supName;
      


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
    public function show(SupplierPayment $supplierPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplierPayment $supplierPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplierPayment $supplierPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierPayment $supplierPayment)
    {
        //
    }
}
