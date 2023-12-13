@extends('layouts.app')

@push('page-styles')
{{-- - - --}}
@endpush

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content my-3">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-1">
                    <h2 class="page-header-title d-flex">
                        <i class="menu-icon mdi mdi-cash-usd me-2"></i>
                        <b> Update Supplier Payment</b>
                       
                    </h2>
                </div>
            </div>

            @include('partials._breadcrumbs')
        </div>
    </div>
</header>

<div class="container-xl px-2 mt-n10">
    <form action="{{ route('supplierPayment.update',$supplierPayment->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        Payment Details
                    </div>
                    <div class="card-body">
                        

                            <div class="col-md-6">
                                <label class="small mb-1" for="supName">Supplier Name
                                    <span class="text-danger">*</span></label>
                                       
                                <select class="form-select form-control-solid @error('supName') is-invalid @enderror"
                                    id="supName" name="supName">
                                    <option selected="" disabled="">Select a Supplier:</option>
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{old('supName')}}" @if (old('supName')==$supplier->id)
                                        selected="selected" @endif>
                                        {{ $supplier->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('supName')
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
                             value="{{ old('date',$supplierPayment->pay_date) }}"
                                name="date" placeholder="dd/mm/yyyy" required>

                            @if($errors->has('date'))
                            <span class="text-danger"> {{ $errors->first('date') }}</span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label for="pay" class="float-start">
                                <h6>Paid Amount<span class="text-danger">*</span></h6>
                            </label>
                        
                            <input type="text" id="pay" class="form-control" value="{{ old('pay',$supplierPayment->amount) }}" name="pay"
                                placeholder="Supplier Payment" required>
                            @if($errors->has('pay'))
                            <span class="text-danger"> {{ $errors->first('pay') }}</span>
                            @endif
                        </div>
                    </div>

                        <button class="btn btn-primary mt-3" type="submit">Save</button>
                        <a class="btn btn-danger mt-3" href="{{ route('products.index') }}">Cancel</a>
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