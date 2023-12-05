<?php

namespace App\Http\Controllers;


use Carbon\Carbon;

use App\Models\SalesDetails;
use Illuminate\Http\Request;
use App\Models\PurchaseDetails;

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
        $fromDate = Carbon::parse($request->input('from_date'))->startOfDay();
        $toDate = Carbon::parse($request->input('to_date'))->endOfDay();

        $purchaseDetails = PurchaseDetails::whereHas('purchase', function ($query) use ($fromDate, $toDate) {
            $query->whereBetween('purchase_date', [$fromDate, $toDate]);
        })->get();

        return view('report.purchaseReport', compact('purchaseDetails', 'fromDate', 'toDate'));
    }

}
