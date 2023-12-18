

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
            <p><strong>Reference No:</strong> {{ $purchase->reference_no }}</p>
            <p><strong>Purchase Date:</strong> {{ $purchase->purchase_date }}</p>
            <p><strong>Supplier:</strong> {{ $purchase->supplier->name }}</p>
        </div>
        <div>
            <p><strong>Total Amount:</strong> ${{ $purchase->grand_total }}</p>
           
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
          
          
                
            @foreach ($purchaseDetails as $pd)
            <tr>
                <td>{{ $pd->product->product_name }}</td>
                <td>{{ $pd->quantity }}</td>
                <td>{{ $pd->unit_price }}</td>
                <td>{{ $pd->tax }} {{ $pd->discount_type==0?"%":"BDT"}}</td>
                <td>{{ $pd->discount }} {{ $pd->discount_type==0?"%":"BDT"}}</td>
                <td>{{ $pd->sub_amount }}</td>
            </tr>
        @endforeach
                
        </tbody>
    </table>

    <div class="total-section">
        <p><strong>Sub Amount:</strong> ${{ $purchase->sub_amount }}</p>
        <p><strong>Discount:</strong> ${{ $purchase->discount }}</p>
        <p><strong>Total:</strong> ${{ $purchase->grand_total }}</p>
    </div>
</div>



<!-- END: Main Page Content -->

@endsection
@push('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpush

