<?php
namespace App\Http\Controllers;

use DB;
use App\Models\Sale;
use App\Models\SalesDetails;
use App\Models\Stock;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SaleController extends Controller
{
    public function index()
    {
        {
            $row = (int) request('row',10);
            if($row<1 || $row>100){
                abort(400,'The per-page parameter must be integer between 1 to 100.');
            }
            $sale=Sale::paginate($row);
            return view('sale.index',compact('sale'));
        }
    }

    public function create()
    {
        $customer=Customer::get();
        return view('sale.create',compact('customer'));
    }


    public function check_stock(Request $request)
    {
        $stock=Stock::where('product_id',$request->item_id)->sum('quantity');
        print_r(json_encode($stock));
    }

    public function product_search_data(Request $request)
    {
        $stock=Stock::where('product_id',$request->item_id)->sum('quantity');
        if($stock > 0){
            $product=Product::where('id',$request->item_id)->first();
            $data='<tr class="text-center">';
            $data.='<td class="p-2">'.$product->product_name.'<input name="product_id[]" type="hidden" value="'.$product->id.'"></td>';

            $data.='<td class="p-2"><input onkeyup="get_cal(this);check_stock(this,'.$product->id.')" name="qty[]" type="text" class="form-control qty" value="0"></td>';
            $data.='<td class="p-2"><input onkeyup="get_cal(this)" name="price[]" type="text" class="form-control price" value="'.$product->selling_price.'"></td>';
            $data.='<td class="p-2"><input onkeyup="get_cal(this)" name="tax[]" type="text" class="form-control tax" value=""></td>';
            $data.='<td class="p-2">
                        <select onchange="get_cal(this)" class="form-control form-select discount_type" name="discount_type[]">
                            <option value="0">%</option>
                            <option value="1">Fixed</option>
                        </select>
                    </td>';
            $data.='<td class="p-2"><input onkeyup="get_cal(this)" name="discount[]" type="text" class="form-control discount" value="0"></td>';
            $data.='<td class="p-2"><input name="unit_cost[]" readonly type="text" class="form-control unit_cost" value="0"></td>';
            $data.='<td class="p-2"><input name="subtotal[]" readonly type="text" class="form-control subtotal" value="0"></td>';
            $data.='<td class="p-2 text-danger"><i style="font-size:1.7rem" onclick="removerow(this)" class="fa fa-dash-circle-fill"></i></td>';
            $data.='</tr>';

            print_r(json_encode($data));
        }else{
            print_r(json_encode('No Stock'));
        }

    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $sale= new Sale;
            $sale->customer_id=$request->customerName;
            $sale->sales_date = $request->sale_date;
            $sale->reference_no=$request->reference_no;
            $sale->total_quantity=$request->total_qty;
            $sale->sub_amount=$request->tsubtotal;
            $sale->discount_type=$request->discount_all_type;
            $sale->discount=$request->discount_all;
            $sale->other_charge=$request->tother_charge;
            $sale->round_of=$request->troundof;
            $sale->grand_total=$request->tgrandtotal;
            $sale->note=$request->note;
            $sale->created_by=currentUserId();

            $sale->payment_status=0;
            $sale->status=1;
            if($sale->save()){
                if($request->product_id){
                    foreach($request->product_id as $i=>$product_id){
                        $sd=new SalesDetails;
                        $sd->sales_id=$sale->id;
                        $sd->product_id=$product_id;
                        $sd->quantity=$request->qty[$i];
                        $sd->unit_price=$request->price[$i];
                        $sd->tax=$request->tax[$i]>0?$request->tax[$i]:0;
                        $sd->discount_type=$request->discount_type[$i];
                        $sd->discount=$request->discount[$i];
                        $sd->sub_amount=$request->unit_cost[$i];
                        $sd->total_amount=$request->subtotal[$i];
                        if($sd->save()){
                            $stock=new Stock;
                            $stock->sales_id=$sale->id;
                            $stock->product_id=$product_id;
                            $stock->quantity='-'.$sd->quantity;
                            $stock->unit_price=($sd->total_amount / $sd->quantity);
                            $stock->tax=$sd->tax;
                            $stock->discount=$sd->discount;
                            $stock->save();

                            DB::commit();
                        }
                    }
                }
                \Toastr::success('Create Successfully!');
                return redirect()->route('sale.index');
            }
        }catch(Exception $e){
            DB::rollback();
            dd($e);
            \Toastr::warning('Please try again!');
            return redirect()->back()->withInput();
        }
    }

    public function show(Sale $id)
    {
        $sales = Sale::with('details')->get();
        $products = Sale::with('details')->get();

         return view('sale.salesDetails', compact('sales','products'));
    }

    public function edit(Sale $id)
    {
        $sale=Sale::find($id);
        return view('sale.edit',compact('sale'));
    }

    public function update(Request $request, Sale $sale)
    {
        try {
            $sale=Sale::find($id);
            $sale->sale_date=$request->saleDate;
            $sale->customer_id=$request->customerName;
            $sale->reference_no=$request-> saleNo;
            $sale->purchase_status=$request->status;
            $sale->sub_amount=$request->subAmount;
            $sale->discount=$request->discount;
            $sale->total_amount=$request->total;
            $sale->updated_by=currentUserId();
            $sale->save();
            $this->notice::success('Data successfully updated');
            return redirect('sales.index');

        } catch (Exception $e) {
            dd($e);
        }
    }

    public function destroy(Sale $id)
    {
        $purchase=Sale::find($id);
       SalesDetails::where('sales_id',$id)->delete();
        Stock::where('sales_id',$id)->delete();
        $purchase->delete();
        $this->notice::success('Data successfully deleted');
        return redirect()->back();
    }

    public function invoice(string $id)
    {
        $saleDetails = SalesDetails::where('sales_id', $id)->get();
        $sale = Sale::find($id);
        return view('sale.invoice', compact('saleDetails', 'sale'));
    }
    
    }
