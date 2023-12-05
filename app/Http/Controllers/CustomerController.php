<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\Customer;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info=Customer::paginate(10);
        return view('customers.index',compact('info'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {

        try {
            $info= new Customer();
            $info->name=$request->customerName;
            $info->email=$request->EmailAddress;
            $info->address=$request->Address;
            $info->contact=$request->phoneNumber;
            $info->created_by=currentUserId();

            $info->save();
            $this->notice::success('Customer successfully added');
            return redirect()->route('customers.index');

        } catch (Exception $e) {
            dd($e);
            return back();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)

    {
        $info=Customer::findorFail(encryptor('decrypt',$id));
        return view('customers.edit',compact('info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        try {
            $info= Customer::find($id);
            $info->name=$request->customerName;
            $info->email=$request->EmailAddress;
            $info->address=$request->Address;
            $info->contact=$request->phoneNumber;
            $info->updated_by=currentUserId();
            if( $info->save()){
                $this->notice::success('Data successfully Updated');
                return redirect()->route('customers.index');
            }

        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)

    {
        $info= Customer::findOrFail(encryptor('decrypt',$id));
        $info->delete();
        $this->notice::success('Data successfully deleted');
        return redirect()->back();
    }
}
