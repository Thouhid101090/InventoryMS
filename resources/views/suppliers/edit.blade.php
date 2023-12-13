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
                    <div class="col-auto ">
                        <h2 class="page-header-title d-flex">
                            <i class="menu-icon mdi mdi-account-multiple me-2"></i>
                            <b> Update Supplier</b>
                        </h2>
                    </div>
                </div>

                {{-- @include('partials._breadcrumbs') --}}
            </div>
        </div>
    </header>
    <!-- END: Header -->

    <!-- BEGIN: Main Page Content -->
    <div class="container-xl px-4 mt-n10">
        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">


                <div class="col-xl-12">
                    <!-- BEGIN: Customer Details -->
                    <div class="card mb-4">
                        <div class="card-header">
                            Customer Details
                        </div>
                        <div class="card-body">
                            <!-- Form Group (name) -->
                            <div class="mb-3">
                                <label class="small mb-1" for="suppliersName">Supplier Name<span
                                        class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('suppliersName') is-invalid @enderror"
                                    id="supplierName" name="suppliersName" type="text" placeholder=""
                                    value="{{ old('suppliersName', $supplier->name) }}" />
                                @error('suppliersName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- Form Group (email address) -->
                            <div class="mb-3">
                                <label class="small mb-1" for="EmailAddress">Email Address<span
                                        class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('EmailAddress') is-invalid @enderror"
                                    id="EmailAddress" name="EmailAddress" type="email" placeholder=""
                                    value="{{ old('EmailAddress', $supplier->email) }}" />
                                @error('EmailAddress')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Form Group (address) -->
                            <div class="mb-3">
                                <label for="Address">Address <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-solid @error('Address') is-invalid @enderror" id="Address" name="Address"
                                    rows="3">{{ old('address', $supplier->address) }}</textarea>
                                @error('Address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Form Row -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number) -->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="phone">Phone number<span
                                            class="text-danger">*</span></label>
                                    <input
                                        class="form-control form-control-solid @error('phoneNumber') is-invalid @enderror"
                                        id="phoneNumber" name="phoneNumber" type="text" placeholder=""
                                        value="{{ old('phoneNumber', $supplier->contact) }}" />
                                    @error('phoneNumber')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>





                            <!-- Submit button -->
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a class="btn btn-danger" href="{{ route('suppliers.index') }}">Cancel</a>
                        </div>
                    </div>
                    <!-- END: Customer Details -->
                </div>
            </div>
        </form>
    </div>
    <!-- END: Main Page Content -->
@endsection

@push('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpush
