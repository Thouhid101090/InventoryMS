@extends('layouts.app')

@section('content')
<header style="padding-bottom: 6rem;
background-color: #8e9298 !important;
background-image: linear-gradient(135deg, #9fa3a8 0%, #cde3e1 100%) !important;" class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content my-3">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto ">
                    <h2 class="page-header-title d-flex">
                        <i class="menu-icon mdi mdi-lan me-2"></i>
                        <b>Category List</b> 
                    </h2>
                </div>
                <div class="col-auto">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary add-list">Add</a>
                    <a href="{{ route('categories.index') }}" class="btn btn-danger add-list">Clear Search</a>
                </div>
            </div>

           {{-- <nav class="mt-4 rounded" aria-label="breadcrumb">
               <ol class="breadcrumb px-3 py-2 rounded mb-0">
                   <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                   <li class="breadcrumb-item active">Categories</li>
               </ol>
           </nav> --}}
            {{-- @include('partials._breadcrumbs', ['model' => $categories]) --}}
        </div>
    </div>

    {{-- @include('partials.session') --}}
</header>

<div style="margin-top: -8rem;" class="container px-4 mt-n10">
    @if($categories->isEmpty())
        <div class="card mb-4">
            <div class="card-body">
                <div class="row mx-n4 px-4">
                    <div class="col-lg-12 p-10 border border-1 rounded text-center align-middle">

                        <p class="mx-auto">
                            You don't have any categories yet.
                        </p>

                        <a href="{{ route('categories.create') }}" class="btn btn-outline-primary">
                            <i class="fa-solid fa-plus me-3"></i>
                            {{ __('Create') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card mb-4">
            <div class="card-body">
                <div class="row mx-n4">
                    <div class="col-lg-12 card-header mt-n4">
                        <form action="{{ route('categories.index') }}" method="GET">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="form-group row align-items-center">
                                    <label for="row" class="col-auto">Row:</label>
                                    <div class="col-auto">
                                        <label>
                                            <select class="form-control" name="row">
                                                <option value="10" @if(request('row') == '10')selected="selected"@endif>10</option>
                                                <option value="25" @if(request('row') == '25')selected="selected"@endif>25</option>
                                                <option value="50" @if(request('row') == '50')selected="selected"@endif>50</option>
                                                <option value="100" @if(request('row') == '100')selected="selected"@endif>100</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row align-items-center justify-content-between">
                                    <label class="control-label col-sm-3" for="search">Search:</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" id="search" class="form-control me-1" name="search" placeholder="Search category" value="{{ request('search') }}">
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
                                    <th scope="col">No.</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <th scope="row">{{ (($categories->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            {{-- Edit --}}
                                            <div class="d-flex">
                                                <a href="{{ route('categories.edit',encryptor('encrypt', $category->id)) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="mdi mdi-border-color

                                                    "></i></a>
                                                {{-- delete --}}
                                                <form action="{{ route('categories.destroy', encryptor('encrypt', $category->id) )}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">
                                                        <i class="mdi mdi-delete
                                                        "></i>
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

                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
