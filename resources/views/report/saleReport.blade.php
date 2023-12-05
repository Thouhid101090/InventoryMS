@extends('layouts.app')
@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa-solid fa-users"></i></div>
                            Sale Report
                        </h1>
                    </div>
                </div>
                {{-- @include('partials._breadcrumbs', ['model' => $users]) --}}
            </div>
        </div>
        @include('partials.session')
    </header>
    <div class="container px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row mx-n4">
                    <div class="col-lg-12 card-header mt-n4">
                        <form action="{{ route('sale-report.generate') }}" method="post">
                            @csrf
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="form-group row align-items-center">
                                    <label for="from_date" class="col-auto">From Date:</label>
                                    <input class="form-control" type="date" name="from_date" value="{{ $fromDate ?? '' }}" required>
                                    <label for="to_date" class="col-auto">To Date:</label>
                                    <input class="form-control" type="date" name="to_date" value="{{ $toDate ?? '' }}" required>
                                    <button type="submit">Generate Report</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{__('No.')}}</th>
                                        <th scope="col">{{__('Product Name')}}</th>
                                        <th scope="col">{{__('Entry Date')}}</th>
                                        <th scope="col">{{__('Customer Name')}}</th>
                                        <th scope="col">{{__('Quentity')}}</th>
                                        <th scope="col">{{__('Unit Price')}}</th>
                                        <th scope="col">{{__('Discount')}}</th>
                                        <th scope="col">{{__('Discount Type')}}</th>
                                        <th scope="col">{{__('V.A.T')}}</th>
                                        <th scope="col">{{__('Sub Total')}}</th>
                                        <th scope="col">{{__('Total')}}</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($salesDetails as $sd)
                                    <tr>
                                        <td>{{$sd->id}}</td>
                                        <td>{{ $sd->product->product_name }}</td>
                                        <td>{{ $sd->created_at }}</td>
                                        <td>{{ $sd->sale->customer_id }}</td>
                                        <td>{{ $sd->quantity }}</td>
                                        <td>{{ $sd->unit_price}}</td>
                                        <td>{{ $sd->discount}}</td>
                                        <td>{{ $sd->discount_type}}</td>
                                        <td>{{ $sd->tax}}</td>
                                        <td></td>
                                        <td>{{ $sd->total_amount}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
