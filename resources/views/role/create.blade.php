@extends('layouts.app')

@push('page-styles')
    {{--- ---}}
@endpush

@section('content')
<!-- BEGIN: Header -->
<header style="padding-bottom: 6rem;
background-color: #8e9298 !important;
background-image: linear-gradient(135deg, #9fa3a8 0%, #cde3e1 100%) !important;" class="page-header page-header-dark mb-1">
    <div class="container-xl px-4">
        <div class="page-header-content pt-1">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h2 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-folder"></i></div>
                        <b>Add Role</b>
                    </h2>
                </div>
            </div>

            {{-- @include('partials._breadcrumbs') --}}
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div style="margin-top: -6rem;"  class="container-xl px-2 mt-n10">
    <form action="{{route('role.store')}}" method="POST">
        @csrf
        <div class="row">

            <div class="col-xl-12">
                <!-- BEGIN: Category Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Role Details
                    </div>
                    <div class="card-body">
                        <!-- Form Group (name) -->
                        <div class="mb-3">
                            <label for="Identity">Identity (only Alpha Character)<i class="text-danger">*</i></label>
                            <input class="form-control form-control-solid @error('Identity') is-invalid @enderror" pattern="[A-Za-z]+" id="Identity" name="Identity" type="text" placeholder="" value="{{ old('Identity') }}" autocomplete="off" />
                            @error('Identity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- Form Group (slug) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="slug">Name</label>
                            <input class="form-control form-control-solid @error('Name') is-invalid @enderror" id="Name" name="Name" type="text" placeholder="" value="{{ old('Name') }}"  />
                            @error('Name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a class="btn btn-danger" href="{{route('role.index')}}">Cancel</a>
                    </div>
                </div>
                <!-- END: Category Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection

@push('page-scripts')
    
@endpush
