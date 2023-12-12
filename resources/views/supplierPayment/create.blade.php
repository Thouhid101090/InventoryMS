@extends('layouts.app')

@push('page-styles')
{{-- - - --}}
@endpush

@section('content')
<!-- BEGIN: Header -->
<header style="padding-bottom: 6rem;
background-color: #8e9298 !important;
background-image: linear-gradient(135deg, #9fa3a8 0%, #cde3e1 100%) !important;"
 class="page-header page-header-dark">
    <div class="container-xl px-4">
        <div class="page-header-content pt-1">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-1">
                    <h2 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Add Supplier Payment
                    </h2>
                </div>
            </div>

            {{-- @include('partials._breadcrumbs') --}}
        </div>
    </div>
</header>

<div style="margin-top: -8rem;" class="container-xl px-2 mt-n10">
    <form action="{{ route('supplierPayment.store') }}" method="POST">
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
                                    <option value="{{ $supplier->id }}" @if (old('supName')==$supplier->id)
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
                        <a class="btn btn-danger mt-3" href="{{ route('supplierPayment.index') }}">Cancel</a>
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