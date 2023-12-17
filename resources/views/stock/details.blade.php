@extends('layouts.app')

@push('page-styles')
    {{--- ---}}
@endpush

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark">
    <div class="container-xl px-4">
        <div class="page-header-content my-3">
            <div class="row align-items-center justify-content-between">
                <h2 class="page-header-title d-flex">
                    <i class="menu-icon mdi mdi-clipboard-text me-2"></i>
                    <b>Product Report</b>
                </h2>
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
                <div class="col-lg-12 card-header mt-n4">
                    <form action="{{ route('stock.details',$product_id)}}" method="GET">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="form-group row align-items-center">
                                <label for="row" class="col-auto">Row:</label>
                                <div class="col-auto">
                                    <select class="form-control" name="row">
                                        <option value="10" @if(request('row') == '10')selected="selected"@endif>10</option>
                                        <option value="25" @if(request('row') == '25')selected="selected"@endif>25</option>
                                        <option value="50" @if(request('row') == '50')selected="selected"@endif>50</option>
                                        <option value="100" @if(request('row') == '100')selected="selected"@endif>100</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-between">
                                <label class="control-label col-sm-3" for="search">Search:</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" id="search" class="form-control me-1" name="search" placeholder="Search product" value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="input-group-text bg-primary"><i class="mdi mdi-account-search font-size-20 text-white"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <hr>

                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th rowspan="2">{{__('No.')}}</th>
                                    <th rowspan="2">{{__('Date')}}</th>
                                    <th colspan="3">{{__('Purchase')}}</th>
                                    <th colspan="3">{{__('Sales')}}</th>
                                    <th colspan="2">{{__('Balance')}}</th>
                                </tr>
                                <tr>
                                    <th>{{__('Qty')}}</th>
                                    <th>{{__('Price')}}</th>
                                    <th>{{__('Total')}}</th>
                                    <th>{{__('Qty')}}</th>
                                    <th>{{__('Price')}}</th>
                                    <th>{{__('Total')}}</th>
                                    <th>{{__('Qty')}}</th>
                                    <th>{{__('Total')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total_sales=$total_purchase=$balance=0 @endphp
                                @php $total_sales_qty=$total_purchase_qty=$balance_qty=0 @endphp

                               @forelse ($stock as $st)
                                <tr>
                                    <td>{{++$loop->index}}</td>
                                    <td>{{\Carbon\Carbon::parse($st['updated_at'])->format('M d Y')}}</td>
                                    @if($st->purchase_id)
                                        @php 
                                            $total_purchase+=$st->unit_price * $st->quantity;
                                            $total_purchase_qty+=$st->quantity;
                                        @endphp
                                        <td>{{$st->quantity}}</td>
                                        <td>{{$st->unit_price}}</td>
                                        <td>{{$st->unit_price * $st->quantity}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$balance_qty+=$st->quantity}}</td>
                                        <td>{{$balance+=($st->unit_price * $st->quantity)}}</td>
                                        <td></td>
                                    @elseif($st->sales_id)
                                        @php 
                                            $total_sales+=$st->unit_price * abs($st->quantity);
                                            $total_sales_qty+=abs($st->quantity);
                                        @endphp
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{abs($st->quantity)}}</td>
                                        <td>{{$st->unit_price}}</td>
                                        <td>{{$st->unit_price * abs($st->quantity)}}</td>
                                        <td>{{$balance_qty+=$st->quantity}}</td>
                                        <td>{{$balance+=($st->unit_price * $st->quantity)}}</td>
                                        <td></td>
                                    @endif
                                </tr>
                               @empty
                                   
                               @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="text-end">Total</th>
                                    <th>{{$total_purchase_qty}}</th>
                                    <th></th>
                                    <th>{{$total_purchase}}</th>
                                    <th>{{$total_sales_qty}}</th>
                                    <th></th>
                                    <th>{{$total_sales}}</th>
                                    <th>{{$balance_qty}}</th>
                                    <th>{{$balance}}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                {{-- {{ $customerPayment->links() }} --}}
            </div>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection

@push('page-scripts')
    {{--- ---}}
@endpush
