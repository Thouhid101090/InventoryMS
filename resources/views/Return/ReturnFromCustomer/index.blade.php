{{-- resources/views/return/ReturnFromCustomer/index.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                Returns from Customers
            </div>
            <div class="card-body">


                <table class="table">
                    <thead>
                        <tr>
                            <th>Reference Number</th>
                            <th>Sales Date</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Returned Quantity</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($returnFromCustomers as $return)
                            <tr>
                                <td>{{ $return->ref_no }}</td>
                                <td>{{ $return->sales_date }}</td>
                                {{-- <td>{{ $return->customer->name }}</td>
                                <td>{{ $return->product->product_name }}</td> --}}
                                <td>{{ $return->returned_quantity }}</td>
                                <td>{{ $return->total_amount }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No returns from customers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
