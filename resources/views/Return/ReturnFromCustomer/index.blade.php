

@extends('layouts.app')

@section('content')
<header  class="page-header page-header-dark">
    <div class="container-xl px-4">
        <div class="page-header-content my-3">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <h2 class="page-header-title d-flex">
                        <i class="menu-icon mdi mdi-undo-variant me-2"></i>
                         Customers Return Details
                    </h2>
                </div>
                <div class="col-auto">
                <a href="{{route('rtnFromCust.create')}}" class="btn btn-primary">Add</a>
                <a href="{{route('rtnFromCust.index')}}" class="btn btn-danger">Cancel</a>
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
                            <th>{{__('Sales Date')}}</th>
                            <th>{{__('Customer')}}</th>
                            <th>{{__('Product')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Total Price')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($returnFromCustomers as $r)
                            <tr>
                                <td>{{ $r->ref_no }}</td>
                                <td>{{ $r->sales_date }}</td>
                                <td>{{ $r->customer->name }}</td>
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
