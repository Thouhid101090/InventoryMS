<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use DB;
class StockController extends Controller
{
   public function index(){
      $row = (int) request('row',10);
      if($row<1 || $row>100){
          abort(400,'The per-page parameter must be integer between 1 to 100.');
      }
      $stocks=DB::select("SELECT products.id,products.product_name,sum(`quantity`) as balance,sum(`quantity` * `unit_price`) as stock_value FROM `stocks` JOIN products on products.id=stocks.product_id GROUP BY stocks.product_id");
      return view('stock.stock',compact('stocks'));
   }

   public function details($product_id){
     
      $stock=Stock::where('product_id',$product_id)->get();
      return view('stock.details',compact('stock','product_id'));
   }
}
// In your controller or wherever you retrieve the stocks

