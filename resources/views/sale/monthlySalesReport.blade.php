@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                <h1>Monthly Sales Report</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Sale Date</th>
                            <th>Customer</th>
                            <th>Reference Number</th>
                            <th>Sub Amount</th>
                            <th>Discount</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($monthlySales as $sale)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sale->sales_date }}</td>
                                <td>{{ $sale->customer->name }}</td>
                                <td>{{ $sale->reference_no }}</td>
                                <td>{{ $sale->sub_amount }}</td>
                                <td>{{ $sale->discount }}</td>
                                <td>{{ $sale->grand_total }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No sales records for this month.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
