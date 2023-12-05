<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
   public function index(){

      $row = (int) request('row',10);
      if($row<1 || $row>100){
          abort(400,'The per-page parameter must be integer between 1 to 100.');
      }
      $stocks=Stock::paginate($row);
      return view('stock.stock',compact('stocks'));
      
     
   }
}
