<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier=Supplier::paginate(10);
        return view('suppliers.index',compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
           $supplier=new Supplier;
            $supplier->name=$request->suppliersName;
            $supplier->email=$request->EmailAddress;
            $supplier->address=$request->Address;
            $supplier->contact=$request->phoneNumber;
           
            $supplier->created_by=currentUserId();
            if( $supplier->save()){
                $this->notice::success('Supplier successfully Added');
                return redirect()->route('suppliers.index');
            }

        } catch (Exception $e) {
            dd($e);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier=Supplier::find($id);
        return view('suppliers.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $supplier=Supplier::find($id);
            $supplier->name=$request->suppliersName;
            $supplier->email=$request->EmailAddress;
            $supplier->address=$request->Address;
            $supplier->contact=$request->phoneNumber;
            $supplier->product_id=$request->productId;
            $supplier->updated_by=currentUserId();
            $supplier->save();
            $this->notice::success('Data successfully updated');
            return redirect()->route('suppliers.index');
        } catch (Exception $e) {
            dd($e);
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier=Supplier::find($id);
        $supplier->delete();
        $this->notice::success('Data successfully deleted');
        return redirect()->back();
    }
}
