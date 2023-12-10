<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomerPayment;

class CustomerPaymentController extends Controller
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
    
            $customerPayment = CustomerPayment::with(['customer'])
            ->paginate($row)
            ->appends(request()->query());
            return view('customerPayment.index',compact('customerPayment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        return view('customerPayment.create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customerPayment=new CustomerPayment;
        $customerPayment->customer_id=$request->cusName;
        $customerPayment->pay_date=$request->date;
        $customerPayment->amount=$request->pay;
        $customerPayment->created_by=currentUserId();
        $customerPayment->save();
        return redirect()->route('supplierPayment.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerPayment $customerPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerPayment $customerPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerPayment $customerPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerPayment $customerPayment)
    {
        //
    }
}
