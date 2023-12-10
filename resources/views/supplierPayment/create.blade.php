@extends('layouts.app')

@push('page-styles')
    {{-- - - --}}
@endpush

@section('content')
    <!-- BEGIN: Header -->
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                            Add Supplier Payment
                        </h1>
                    </div>
                </div>

                @include('partials._breadcrumbs')
            </div>
        </div>
    </header>

    <div class="container-xl px-2 mt-n10">
        <form action="{{ route('supplierPayment.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            Payment Details
                        </div>
                        <div class="card-body">
                            <div class="row gx-3 mb-3">

                                <div class="col-md-6">
                                    <label class="small mb-1" for="supName">Supplier Name<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select form-control-solid @error('supName') is-invalid @enderror"
                                        id="supName" name="supName">
                                        <option selected="" disabled="">Select a Supplier:</option>
                                        @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" @if (old('supName') == $supplier->id) selected="selected" @endif>
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
                            </div>


                            <div class="col-md-2 mt-2">
                                <label for="date" class="float-end">
                                    <h6>Date<span class="text-danger">*</span></h6>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <input type="date" id="datepicker" class="form-control" value="{{ old('date') }}"
                                    name="date" placeholder="dd/mm/yyyy" required>

                                    @if($errors->has('date'))
                                    <span class="text-danger"> {{ $errors->first('date') }}</span>
                                    @endif
                            </div>
                            <div class="col-md-2 mt-2">
                                <label for="pay" class="float-end">
                                    <h6>Payment<span class="text-danger">*</span></h6>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="pay" class="form-control" value="{{ old('pay') }}"
                                    name="pay" placeholder="Supplier Payment" required>
                                    @if($errors->has('pay'))
                                    <span class="text-danger"> {{ $errors->first('pay') }}</span>
                                    @endif
                            </div>








                            <!-- Submit button -->
                            <button class="btn btn-primary" type="submit">Save</button>
                            <a class="btn btn-danger" href="{{ route('products.index') }}">Cancel</a>
                        </div>
                    </div>

                </div>
            </div>
        </form>

    </div>
    <!-- END: Main Page Content -->
@endsection

@push('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush
