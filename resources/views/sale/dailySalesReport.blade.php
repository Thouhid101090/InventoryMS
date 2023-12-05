@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                <h1>Daily Sales Report</h1>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <form action="{{ route('sales.daily-report') }}" method="GET">
                    <div class="input-group">
                        <input type="date" class="form-control" name="selected_date" required>
                        <button type="submit" class="btn btn-primary">Show Report</button>
                    </div>
                </form>
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
                        @forelse ($dailySales as $sale)
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
                                <td colspan="7">No sales records for this date.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
