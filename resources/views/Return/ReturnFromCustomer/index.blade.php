@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5>Return Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Customer:</h6>
                        <p>{{ $returnFromCustomer->customer->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Sales Date:</h6>
                        <p>{{ $returnFromCustomer->sales_date }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h6>Returned Products:</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($returnFromCustomer->salesDetails as $salesDetail)
                                    <tr>
                                        <td>{{ $salesDetail->product->product_name }}</td>
                                        <td>{{ $salesDetail->quantity }}</td>
                                        <td>{{ $salesDetail->unit_price }}</td>
                                        <td>{{ $salesDetail->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
