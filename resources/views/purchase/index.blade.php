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
                <div class="col-auto">
                    <h2 class="page-header-title d-flex">
                        <i class="menu-icon mdi mdi-cash-multiple me-2"></i>
                       <b>Purchase List</b> 
                    </h2>
                </div>
                <div class="col-auto">

                    <a href="{{ route('purchase.create') }}"
                        class="btn btn-primary add-list">Add
                    </a>
                    <a href="{{ route('purchase.index') }}"
                        class="btn btn-danger add-list">Clear Search
                    </a>
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
                <div class="col-lg-12 card-header mt-n4">
                    <form action="{{ route('purchase.index') }}" method="GET">
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
                                    <th scope="col">{{__('No.')}}</th>
                                    <th scope="col">{{__('Purchase Date')}}</th>
                                    <th scope="col">{{__('Supplier')}}</th>
                                    <th scope="col">{{__('Purchase No')}}</th>
                                    <th scope="col">{{__('Sub Amount')}}</th>
                                    <th scope="col">{{__('Discount')}}</th>
                                    <th scope="col">{{__('Total')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchase as $p)
                                <tr>
                                    <th scope="row">{{ (($purchase->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>

                                    <td>{{ $p->purchase_date }}</td>
                                    <td>{{ $p->supplier->name }}</td>
                                    <td>{{ $p->reference_no}}</td>
                                    <td>{{ $p->sub_amount }}</td>
                                    <td>{{ $p->discount }}</td>
                                    <td>{{ $p->grand_total }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('purchase.generate-invoice', $p->id) }}" class="btn btn-outline-info btn-sm mx-1">
                                                <i class="mdi mdi-receipt"></i> Generate Invoice
                                            </a>

                                            <a href="{{ route('purchase.show', $p->id) }}" class="btn btn-outline-success btn-sm mx-1"><i class="mdi mdi-eye"></i></a>

                                            <a href="{{ route('purchase.edit', $p->id)}}" class="btn btn-outline-primary btn-sm mx-1"><i class="mdi mdi-border-color"></i></a>

                                            <form action="{{ route('purchase.destroy',encryptor('encrypt',$p->id)) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $purchase->links() }}
            </div>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection

@push('page-scripts')
    {{--- ---}}
@endpush
