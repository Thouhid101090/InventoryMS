<?php

namespace App\Http\Controllers;


use Carbon\Carbon;

use App\Models\SalesDetails;
use Illuminate\Http\Request;
use App\Models\Purchase;
use DB;
class ReportController extends Controller
{

    public function generateSaleReport(Request $request)
    {
        $fromDate = Carbon::parse($request->input('from_date'))->startOfDay();
        $toDate = Carbon::parse($request->input('to_date'))->endOfDay();

        $salesDetails = SalesDetails::whereHas('sale', function ($query) use ($fromDate, $toDate) {
            $query->whereBetween('sales_date', [$fromDate, $toDate]);
        })->get();

        return view('report.saleReport', compact('salesDetails', 'fromDate', 'toDate'));
    }


    public function generatePurchaseReport(Request $request)
    {
        $fromDate = $request->input('from_date')." 00:00:00";
        $toDate =$request->input('to_date')." 23:59:59";
        
        $purchase = Purchase::whereBetween('purchase_date', [$fromDate, $toDate])->get();
        
        return view('report.purchaseReport', compact('purchase', 'fromDate', 'toDate'));
    }

}
