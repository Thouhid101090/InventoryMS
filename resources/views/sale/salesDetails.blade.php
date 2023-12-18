

@extends('layouts.app')


@section('content')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto ">
                    <h2 class="page-header-title d-flex">
                        <i class="menu-icon mdi mdi-cart-outline me-2"></i>
                        <b>Sales Details</b>
                    </h2>
                </div>
            </div>

            {{-- @include('partials._breadcrumbs') --}}
        </div>
    </div>
</header>
<div class="container px-4 mt-n10">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mx-n4">

    <table>
        <thead>
            <tr>
               
                <th>Product</th>
                <th>quantity</th>
                <th>Price</th>
                <th>Sub Total</th>
                <th>Discount</th>
                <th>VAT</th>
                <th>Total</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($sales->details as $detail)
                <tr>
                   
                    <td>{{ $detail->product->product_name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->unit_price }}</td>
                    <td>{{ $detail->sub_amount }}</td>
                    <td>{{ $detail->discount }} {{ $detail->discount_type==0?"%":"BDT"}}</td>
                    <td>{{ $detail->tax }} {{ $detail->discount_type==0?"%":"BDT"}}</td>
                    <td>{{ $detail->total_amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
            </div>
            </div>
            </div>
            </div>
@endsection
