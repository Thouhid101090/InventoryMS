

@extends('layouts.app')

@section('content')
<header  style="padding-bottom: 6rem;
background-color: #8e9298 !important;
background-image: linear-gradient(135deg, #9fa3a8 0%, #cde3e1 100%) !important;" class="page-header page-header-dark">
    <div class="container-xl px-4">
        <div class="page-header-content my-3">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <h2 class="page-header-title d-flex">
                        <i class="menu-icon mdi mdi-undo-variant me-2"></i>
                         Customers Return Details
                    </h2>
                </div>
            </div>
            {{-- @include('partials._breadcrumbs') --}}
        </div>
    </div>
    {{-- @include('partials.session') --}}
</header>
<div class="container px-4 mt-n10">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mx-n4">

                <table class="table">
                    <thead>
                        <tr>
                            <th>{{__('Ref.no')}}</th>
                            <th>{{__('Purchase Date')}}</th>
                            <th>{{__('Supplier')}}</th>
                            <th>{{__('Product')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Total Price')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ReturnToSupplier as $r)
                            <tr>
                                <td>{{ $r->ref_no }}</td>
                                <td>{{ $r->purchase_date }}</td>
                                <td>{{ $r->supplier->name }}</td>
                                <td>{{ $r->product?->product_name}}</td>
                                <td>{{ $r->returned_quantity }}</td>
                                <td>{{ $r->total_amount }}</td>
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
    </div>
@endsection
