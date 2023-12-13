@extends('layouts.app')

@push('page-styles')
{{-- - - --}}
@endpush

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark">
    <div class="container-xl px-4">
        <div class="page-header-content my-3">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto ">
                    <h2 class="page-header-title d-flex">
                        <i class="menu-icon mdi mdi-cash-usd me-2"></i>
                        <b> Add Customer Payment</b>
                       
                    </h2>
                </div>
            </div>

            {{-- @include('partials._breadcrumbs') --}}
        </div>
    </div>
</header>

<div class="container-xl px-4 mt-n10">
    <form action="{{ route('customerPayment.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        Payment Details
                    </div>
                    <div class="card-body">
                        

                            <div class="col-md-6">
                                <label class="small mb-1" for="supName">Customer Name
                                    <span class="text-danger">*</span></label>
                                       
                                <select class="form-select form-control-solid @error('cusName') is-invalid @enderror"
                                    id="cusName" name="cusName">
                                    <option selected="" disabled="">Select a Customer:</option>
                                    @foreach ($customers as $c)
                                    <option value="{{ $c->id }}" @if (old('cusName')==$c->id)
                                        selected="selected" @endif>
                                        {{ $c->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('cusName')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        

                            <div class="row d-flax mt-3">
                            <div class="col-md-4">
                            <label for="date" class="float-start">
                                <h6>Date<span class="text-danger">*</span></h6>
                            </label>
                       
                            <input type="date" id="datepicker" class="form-control form-control-solid
                             @error('date') is-invalid @enderror"
                             value="{{ old('date') }}"
                                name="date" placeholder="dd/mm/yyyy" required>

                            @if($errors->has('date'))
                            <span class="text-danger"> {{ $errors->first('date') }}</span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label for="pay" class="float-start">
                                <h6>Paid Amount<span class="text-danger">*</span></h6>
                            </label>
                        
                            <input type="text" id="pay" class="form-control" value="{{ old('pay') }}" name="pay"
                                placeholder="Supplier Payment" required>
                            @if($errors->has('pay'))
                            <span class="text-danger"> {{ $errors->first('pay') }}</span>
                            @endif
                        </div>
                    </div>

                        <button class="btn btn-primary mt-3" type="submit">Save</button>
                        <a class="btn btn-danger mt-3" href="{{ route('customerPayment.index') }}">Cancel</a>
                    </div>
                </div>

            </div>
        </div>
    </form>

</div>
@endsection

@push('page-scripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush