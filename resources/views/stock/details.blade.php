@extends('layouts.app')

@push('page-styles')
<style>
    table,
    th,
    td {
        border: 2px solid black;
        padding: .7rem;
        font-size: 1rem;
        
    }
</style>
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

                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle text-center">
                            <colgroup>
                                <col span="2" style="background-color: #fff">
                                <col span="3" style="background-color: #759898">
                                <col span="3" style="background-color: #9ce3e3">
                                <col span="3" style="background-color: #779090">
                                <col span="3" style="background-color: #adf0f0">
                                <col span="1" style="background-color: #9aa0a0">
                            </colgroup>
                            <thead class="thead-light">
                                <tr>
                                    <th rowspan="2">{{__('No.')}}</th>
                                    <th rowspan="2">{{__('Date')}}</th>
                                    <th class="text-center" colspan="3">{{__('Purchase')}}</th>
                                    <th class="text-center" colspan="3">{{__('Sales')}}</th>
                                    <th class="text-center" colspan="3">{{__('Return From Customer')}}</th>
                                    <th class="text-center" colspan="3">{{__('Return To Supplier')}}</th>
                                    <th class="text-center" colspan="1">{{__('Balance')}}</th>
                                </tr>
                                <tr>
                                    <th>{{__('Qty')}}</th>
                                    <th>{{__('Price')}}</th>
                                    <th>{{__('Total')}}</th>
                                    <th>{{__('Qty')}}</th>
                                    <th>{{__('Price')}}</th>
                                    <th>{{__('Total')}}</th>
                                    <th>{{__('Qty')}}</th>
                                    <th>{{__('Price')}}</th>
                                    <th>{{__('Total')}}</th>
                                    <th>{{__('Qty')}}</th>
                                    <th>{{__('Price')}}</th>
                                    <th>{{__('Total')}}</th>
                                    <th>{{__('Qty')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total_sales=$total_purchase=$total_return_from_customer=$total_return_to_supplier=$balance=0
                                @endphp
                                @php
                                $total_sales_qty=$total_purchase_qty=$return_from_customer_qty=$return_to_supplier_qty=$balance_qty=0
                                @endphp

                                @forelse ($stock as $st)
                                <tr>
                                    <td>{{++$loop->index}}</td>
                                    <td>
                                        
                                        @if($st->sale)
                                        {{\Carbon\Carbon::parse($st->sale->sales_date)->format('M d Y')}}
                                        @elseif ($st->purchase)
                                        {{\Carbon\Carbon::parse($st->purchase->purchase_date)->format('M d Y')}}
                                        @elseif ($st->rtcustomer)
                                        
                                        {{ \Carbon\Carbon::parse($st->rtcustomer->created_at)->format('M d
                                        Y') }}
                                        @elseif ($st->rtsupplier)
                                        {{ \Carbon\Carbon::parse($st->rtsupplier->created_at)->format('M d Y')
                                        }}
                                        @endif
                                    </td>
                                    @if($st->purchase_id)
                                    @php
                                    $total_purchase+=$st->unit_price * $st->quantity;
                                    $total_purchase_qty+=$st->quantity;
                                    $balance+=($st->unit_price * $st->quantity);
                                    @endphp
                                    <td>{{$st->quantity}}</td>
                                    <td>{{$st->unit_price}}</td>
                                    <td>{{$st->unit_price * $st->quantity}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{$balance_qty+=$st->quantity}}</td>

                                    <td></td>
                                    @elseif($st->sales_id)
                                    @php
                                    $total_sales+=$st->unit_price * abs($st->quantity);
                                    $total_sales_qty+=abs($st->quantity);
                                    $balance-=($st->unit_price * abs($st->quantity));
                                    @endphp
                                    <td></td>
                                    <td></td>
                                    <td></td> 
                                    <td>{{abs($st->quantity)}}</td>
                                    <td>{{$st->unit_price}}</td>
                                    <td>{{$st->unit_price * abs($st->quantity)}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{$balance_qty+=$st->quantity}}</td>

                                    @elseif ($st->return_from_customer_id)
                                    @php
                                        $total_return_from_customer += $st->unit_price * abs($st->quantity);
                                        $return_from_customer_qty += abs($st->quantity);
                                        $balance += $st->unit_price * abs($st->quantity);
                                    @endphp
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ abs($st->quantity) }}</td>
                                    <td>{{ $st->unit_price }}</td>
                                    <td>{{ $st->unit_price * abs($st->quantity) }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $balance_qty += $st->quantity }}</td>
                                    @elseif ($st->return_to_supplier_id)
                                    @php
                                        $total_return_to_supplier += $st->unit_price * abs($st->quantity);
                                        $return_to_supplier_qty += abs($st->quantity);
                                        $balance -= $st->unit_price * abs($st->quantity);
                                    @endphp
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ abs($st->quantity) }}</td>
                                    <td>{{ $st->unit_price }}</td>
                                    <td>{{ $st->unit_price * abs($st->quantity) }}</td>
                                    
                                    <td>{{ $balance_qty += $st->quantity }}</td>
                                    @endif
                                </tr>
                                @empty

                                @endforelse
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th colspan="2" class="text-center">Total</th>
                                    <th>{{$total_purchase_qty}}</th>
                                    <th></th>
                                    <th>{{$total_purchase}}</th>
                                    <th>{{$total_sales_qty}}</th>
                                    <th></th>
                                    <th>{{$total_sales}}</th>
                                    <th>{{$return_from_customer_qty}}</th>
                                    <th></th>
                                    <th>{{$total_return_from_customer}}</th>
                                    <th>{{$return_to_supplier_qty}}</th>
                                    <th></th>
                                    <th>{{$total_return_to_supplier}}</th>
                                    <th>{{$balance_qty}}</th>

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