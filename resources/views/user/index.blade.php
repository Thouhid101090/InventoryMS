@extends('layouts.app')
@section('title',trans('User List'))

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-users"></i></div>
                        User List
                    </h1>
                </div>
                <div class="col-auto my-4">
                    <a href="{{ route('user.create') }}" class="btn btn-primary add-list"><i class="fa-solid fa-plus me-3"></i>Add</a>
                    <a href="{{ route('user.index') }}" class="btn btn-danger add-list"><i class="fa-solid fa-trash me-3"></i>Clear Search</a>
                </div>
            </div>

            {{-- @include('partials._breadcrumbs', ['model' => $users]) --}}
        </div>
    </div>

    @include('partials.session')
</header>

<div class="container px-4 mt-n10">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mx-n4">
                <div class="col-lg-12 card-header mt-n4">
                    <form action="{{ route('user.index') }}" method="GET">
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
                                        <input type="text" id="search" class="form-control me-1" name="search" placeholder="Search user" value="{{ request('search') }}">
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
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{__('No.')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Email')}}</th>
                                    <th scope="col">{{__('Contact')}}</th>
                                    <th scope="col">{{__('Role')}}</th>
                                    <th scope="col">{{__('Image')}}</th>
                                    <th scope="col">{{__('Status')}}</th>
                                    <th class="White-space-newrap">{{__('Action')}}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $user)
                                <tr>
                                    <th scope="row">{{ (($data->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>
                                    <td>{{ $user->name_en }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->contact_no_en }}</td>
                                    <td>{{ $user->role?->name}}</td>

                                    <td><img width="50px" height="50px" class="rounded-circle" src="{{asset('public/uploads/users/'.$user->image)}}" alt=""></td>
                                   <td>@if ($user->status ==1){{__('Active')}} @else {{__('Inactive')}}

                                   @endif</td>




                                    <td class="white_space-nowrap">
                                        <div class="d-flex">
                                            <a href="{{ route('user.edit',encryptor('encrypt',$user->id)) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="mdi mdi-border-color
                                                "></i></a>




                                            <a href="javascript:void()" class="btn btn-outline-danger btn-sm" onclick="document.getElementById('form{{$user->id}}').submit()">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                            <form id="form{{$user->id}}" action="{{route('user.destroy',encryptor('encrypt',$user->id))}}" method="post">
                                                {{-- @php print_r($errors->all()) @endphp --}}
                                                @csrf
                                                @method('delete')
                                            </form>


                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection
