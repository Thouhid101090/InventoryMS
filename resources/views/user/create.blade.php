@extends('layouts.app')

@section('content')
<!-- BEGIN: Header -->
<header style="padding-bottom: 6rem;
background-color: #8e9298 !important;
background-image: linear-gradient(135deg, #9fa3a8 0%, #cde3e1 100%) !important;"  class="page-header page-header-dark ">
    <div class="container-xl px-4">
        <div class="page-header-content pt-1">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-1 ">
                    <h2 class="page-header-title d-flex">
                        <i class="menu-icon mdi mdi-account-key me-2"></i>
                        <b>Add User</b>
                    </h2>
                </div>
            </div>
            {{-- @include('partials._breadcrumbs') --}}
        </div>
    </div>
</header>

<div  style="margin-top: -8rem;" class="container-xl px-4 mt-n10">
    <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image -->
                        <img class="img-account-profile rounded-circle mb-2" src="{{ asset('public/assets/img/demo/user-placeholder.svg') }}" 
                        alt="" id="image-preview" />
                        <!-- Profile picture help block -->
                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 1 MB</div>
                        <!-- Profile picture input -->
                        <input class="form-control form-control-solid mb-2 @error('photo') is-invalid @enderror" type="file"
                          id="image" name="image" accept="image/*" onchange="previewImage();">
                        @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- BEGIN: User Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        User Details
                    </div>
                    <div class="card-body">
                        <!-- Form Group (name) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="name">Role <span class="text-danger">*</span></label>
                           <select class="form-control" name="roleId" id="roleId">
                                <option value="">Select Role</option>
                                @forelse ($role as $r )
                                    <option value="{{$r->id}}" {{old('roleId')==$r->id?'selected':''}}>{{$r->name}}</option>
                                @empty
                                    <option value="">No Role Found</option>
                                @endforelse
                           </select>
                           @if($errors->has('roleId'))
                            <span class="text-danger">{{$errors->first('roleId')}}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="name">Name(English) <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('userName_en') is-invalid @enderror" id="name" name="userName_en" type="text" placeholder="" value="{{ old('userName_en') }}" />
                            @error('userName_en')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="name">Name(Bangla)</label>
                            <input class="form-control form-control-solid @error('userName_bn') is-invalid @enderror" id="name" name="userName_bn" type="text" placeholder="" value="{{ old('userName_bn') }}" />
                            @error('userName_bn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- Form Group (email address) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="EmailAddress">Email
                                <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('EmailAddress') is-invalid @enderror"
                             id="email" name="EmailAddress" type="email" placeholder="" value="{{ old('EmailAddress') }}" />
                            @error('EmailAddress')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- Form Group (username) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="contactNumber_en">Contact(English) <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('contactNumber_en') is-invalid @enderror" id="contactNumber_en" name="contactNumber_en" type="text" placeholder="" value="{{ old('contactNumber_en') }}" />
                            @error('contactNumber_en')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="contactNumber_bn">Contact(Bangla)</label>
                            <input class="form-control form-control-solid @error('contactNumber_bn') is-invalid @enderror" id="contactNumber_bn" name="contactNumber_bn" type="text" placeholder="" value="{{ old('contactNumber_bn') }}" />
                            @error('contactNumber_bn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="status">Status <span class="text-danger">*</span></label>
                           <select class="form-control" name="status" >
                            <option value="1" @if(old('status')==1) selected @endif>Active</option>
                            <option value="0" @if(old('status')==0) selected @endif>Inactive</option>
                           </select>
                            @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="fullAccess">Full Access <span class="text-danger">*</span></label>
                           <select class="form-control" name="fullAccess" >
                            <option value="1" @if(old('fullAccess')==1) selected @endif>Yes</option>
                            <option value="0" @if(old('fullAccess')==0) selected @endif>No</option>
                           </select>
                            @error('fullAccess')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (password) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="password">Password <i class="text-danger">*</i></label>
                                <input class="form-control form-control-solid @error('password') is-invalid @enderror" id="password" name="password" type="password"/>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (password confirmation) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="password_confirmation">Password confirmation</label>
                                <input class="form-control form-control-solid @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" type="password"/>
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a class="btn btn-danger" href="{{route('user.index')}}">Cancel</a>
                    </div>
                </div>
                <!-- END: User Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection

@push('page-scripts')
    <script src="{{ asset('public/assets/js/img-preview.js') }}"></script>
@endpush
