@extends('layouts.app')
@push('page-styles')
<link rel="stylesheet" href="{{asset('public/invoice/style.css')}}">
<style>

</style>
@endpush

@section('content')
<button onclick="window.print()">Print</button>

<div class="invoice-container">
    <div class="invoice-header">
        <h2>Invoice</h2>

    </div>

    <div class="invoice-details">
        <div>
            <p><strong>Reference No:</strong> {{ $sale->reference_no }}</p>
            <p><strong>Sale Date:</strong> {{ $sale->sales_date }}</p>
            <p><strong>Customer:</strong> {{ $sale->customer->name }}</p>
        </div>
        <div>
            <p><strong>Total Amount:</strong> ${{ $sale->grand_total }}</p>

        </div>
    </div>

    <table class="invoice-items">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>V.A.T</th>
                <th>Discount</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>



            @foreach ($saleDetails as $sd)
            <tr>
                <td>{{ $sd->product->product_name }}</td>
                <td>{{ $sd->quantity }}</td>
                <td>{{ $sd->unit_price }}</td>
                <td>{{ $sd->tax }} {{ $sd->discount_type==0?"%":"BDT"}}</td>
                <td>{{ $sd->discount }}{{ $sd->discount_type==0?"%":"BDT"}}</td>
                <td>{{ $sd->sub_amount }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <div class="total-section">
        <p><strong>Sub Amount:</strong> ${{ $sale->sub_amount }}</p>
        <p><strong>Discount:</strong> ${{ $sale->discount }}</p>
        <p><strong>Total:</strong> ${{ $sale->grand_total }}</p>
    </div>
</div>

@endsection
@push('page-scripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>

@endpush
