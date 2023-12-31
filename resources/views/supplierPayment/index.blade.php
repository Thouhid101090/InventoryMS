@extends('layouts.app')

@push('page-styles')
    {{--- ---}}
@endpush

@section('content')
<!-- BEGIN: Header -->
<header  class="page-header page-header-dark">
    <div class="container-xl px-4">
        <div class="page-header-content my-3">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto ">
                    <h2 class="page-header-title d-flex">
                        <i class="menu-icon mdi mdi-cash-usd me-2"></i>
                        <b>Supplier Payment List</b>
                        
                    </h2>
                </div>
                <div class="col-auto">
                    {{-- <a href="{{ route('products.import') }}"
                        class="btn btn-success add-list my-1"><i class="fa-solid fa-file-import me-3"></i>Import
                    </a>
                    <a href="{{ route('products.export') }}"
                        class="btn btn-warning add-list my-1"><i class="fa-solid fa-file-arrow-down me-3"></i>Export
                    <a> --}}
                    <a href="{{ route('supplierPayment.create') }}"
                        class="btn btn-primary add-list">Add
                    </a>
                    <a href="{{ route('supplierPayment.index') }}"
                        class="btn btn-danger add-list "></i>Clear Search
                    </a>
                </div>
            </div>

            {{-- @include('partials._breadcrumbs') --}}
        </div>
    </div>

    @include('partials.session')
</header>

<div  class="container px-4 mt-n10">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mx-n4">
                <div class="col-lg-12 card-header mt-n4">
                    <form action="{{ route('supplierPayment.index') }}" method="GET">
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
                                    <th scope="col">{{__('Supplier')}}</th>
                                    <th scope="col">{{__('Paid Amount')}}</th>
                                    <th scope="col">{{__('Date')}}</th>
                                    <th scope="col">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supplierPayment as $sp)
                                <tr>
                                    <th scope="row">{{ (($supplierPayment->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>
                                    
                                    <td>{{ $sp->supplier->name }}</td>
                                    <td>{{ $sp->amount }}</td>
                                    <td>{{ $sp->pay_date }}</td>
                                    <td>
                                        <div class="d-flex">

                                            <a href="{{ route('supplierPayment.edit',$sp->id) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="mdi mdi-border-color
                                                "></i></a>

                                            <form action="{{ route('supplierPayment.destroy',$sp->id) }}" method="POST">
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

                {{ $supplierPayment->links() }}
            </div>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection

@push('page-scripts')
    {{--- ---}}
@endpush
