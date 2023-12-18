@extends('layouts.app')
@section('content')
    <header style="padding-bottom: 6rem;
    background-color: #8e9298 !important;
    background-image: linear-gradient(135deg, #9fa3a8 0%, #cde3e1 100%) !important;" class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content my-3">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto ">
                        <h2 class="page-header-title d-flex">
                            <i class="menu-icon mdi mdi-clipboard-text me-2"></i>
                            <b>Sales Report</b>

                        </h2>
                    </div>
                </div>
                {{-- @include('partials._breadcrumbs', ['model' => $users]) --}}
            </div>
        </div>
        {{-- @include('partials.session') --}}
    </header>
    <div class="container px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row mx-n4">
                    <div class="col-lg-12 card-header mt-n4">
                        <form action="{{ route('sale-report.generate') }}" method="post">

                                @csrf

                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    {{-- <div class="row"> --}}
                                        {{-- <div class="form-group row align-items-center"> --}}

                                            <div class="col-md-1">
                                                <label for="from_date" class="col-auto">From Date:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control p-3" type="date" name="from_date"
                                                    value="{{ $fromDate ?? '' }}" required>

                                            </div>


                                            <div class="col-md-1">
                                                <label for="to_date" class="col-auto">To Date:</label>
                                            </div>
                                                <div class="col-md-3">
                                                <input class="form-control p-3" type="date" name="to_date"
                                                value="{{ $toDate ?? '' }}" required>
                                              </div>


                                            {{--
                                        </div> --}}


                                        <button class="col-md-2 btn btn-primary" type="submit">Generate Report</button>
                                    </div>
                                    {{-- </div> --}}
                            </form>
                    </div>
                    <hr>
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{__('No.')}}</th>
                                        <th scope="col">{{__('Customer Name')}}</th>
                                        <th scope="col">{{__('Entry Date')}}</th>
                                        <th scope="col">{{__('Quentity')}}</th>
                                        <th scope="col">{{__('Sub Price')}}</th>
                                        <th scope="col">{{__('Discount')}}</th>
                                        <th scope="col">{{__('V.A.T')}}</th>
                                        <th scope="col">{{__('Total')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sales as $sd)
                                    <tr>
                                        <td>{{$sd->id}}</td>
                                        <td>{{ $sd->customer->name }}</td>
                                        <td>{{ $sd->sales_date }}</td>
                                        <td>{{ $sd->total_quantity }}</td>
                                        <td>{{ $sd->sub_amount}}</td>
                                        <td>{{ $sd->discount}} {{ $sd->discount_type==0?"%":"BDT"}}</td>
                                        <td>{{ $sd->tax}}</td>

                                        <td>{{ $sd->grand_total}}</td>
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
