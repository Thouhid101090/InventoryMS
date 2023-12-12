@extends('layouts.app')

@push('page-styles')
    {{--- ---}}
@endpush

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark mb-1">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-1">
                    <h2 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-folder"></i></div>
                        <b>Update Role</b>
                    </h2>
                </div>
            </div>

            {{-- @include('partials._breadcrumbs') --}}
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{route('role.update',encryptor('encrypt',$role->id))}}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$role->id)}}">
        <div class="row">

            <div class="col-xl-12">
                <!-- BEGIN: Category Details -->
                <div class="card mb-4">
                    <div class="card-header">
                       Update Role Details
                    </div>
                    <div class="card-body">
                        <!-- Form Group (Identity) -->
                        <div class="mb-3">
                            <label for="Identity">Identity (only Alpha Character)<i class="text-danger">*</i></label>
                            <input class="form-control form-control-solid @error('Identity') is-invalid @enderror" pattern="[A-Za-z]+" id="Identity" name="Identity" type="text" placeholder="" value="{{ old('Identity',$role->identity) }}" />
                            @error('Identity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- Form Group (Name) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="Name">Name</label>
                            <input class="form-control form-control-solid @error('Name') is-invalid @enderror" id="Name" name="Name" type="text" placeholder="" value="{{ old('Name',$role->name) }}"  />
                            @error('Name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
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
