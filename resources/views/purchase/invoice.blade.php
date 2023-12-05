

@extends('layouts.app')
@push('page-styles')

<style>

    body {
        font-family: Arial, sans-serif;
    }
    .invoice-container {
        width: 80%;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
    }
    .invoice-header {
        text-align: center;
        margin-bottom: 20px;
    }
    .invoice-details {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .invoice-items {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .invoice-items th, .invoice-items td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }
    .total-section {
        margin-top: 20px;
        text-align: right;
    }
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
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchase as $item)
            <tr>
                <td>{{ $item->product->product_name }}</td>
                <td>{{ $item->total_quantity }}</td>
                <td>{{ $item->unit_price }}</td>
                <td>{{ $item->sub_amount }}</td>
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
    <!-- Your HTML code -->


@endpush
