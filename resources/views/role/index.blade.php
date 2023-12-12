@extends('layouts.app')
@section('title', trans('Role'))
@section('page', trans('List'))

@section('content')
    {{-- <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa-solid fa-folder"></i></div>
                            Role List
                        </h1>
                    </div>
                    <div class="col-auto my-4">
                        <a href="{{ route('role.create') }}" class="btn btn-primary add-list"><i
                                class="fa-solid fa-plus me-3"></i>Add</a>
                        <a href="{{ route('role.index') }}" class="btn btn-danger add-list"><i
                                class="fa-solid fa-trash me-3"></i>Clear Search</a>
                    </div>
                </div>

                @include('partials._breadcrumbs', ['model' => $data])
            </div>
        </div>

        @include('partials.session')
    </header> --}}

    <div class="container px-4 mt-n10">
        @if ($data->isEmpty())
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row mx-n4 px-4">
                        <div class="col-lg-12 p-10 border border-1 rounded text-center align-middle">

                            <p class="mx-auto">
                                You don't have any Role yet.
                            </p>

                            <a href="{{ route('role.create') }}" class="btn btn-outline-primary">
                                <i class="fa-solid fa-plus me-3"></i>
                                {{ __('Create') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row mx-n4">
                        <div class="col-lg-12 card-header">
                            <form action="{{ route('role.index') }}" method="GET">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    <div class="form-group row align-items-center">
                                        <label for="row" class="col-auto">Row:</label>
                                        <div class="col-auto">
                                            <label>
                                                <select class="form-control" name="row">
                                                    <option value="10"
                                                        @if (request('row') == '10') selected="selected" @endif>10
                                                    </option>
                                                    <option value="25"
                                                        @if (request('row') == '25') selected="selected" @endif>25
                                                    </option>
                                                    <option value="50"
                                                        @if (request('row') == '50') selected="selected" @endif>50
                                                    </option>
                                                    <option value="100"
                                                        @if (request('row') == '100') selected="selected" @endif>100
                                                    </option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center justify-content-between">
                                        <label class="control-label col-sm-3" for="search">Search:</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" id="search" class="form-control me-1"
                                                    name="search" placeholder="Search category"
                                                    value="{{ request('search') }}">
                                                <div class="input-group-append">
                                                    <button type="submit" class="input-group-text bg-primary">
                                                        <i class="mdi mdi-account-search
                                                        font-size-20 text-white"></i></button>
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
                                            <th scope="col">{{ __('#SL') }}</th>
                                            <th scope="col">{{ __('Name') }}</th>
                                            <th scope="col">{{ __('Identity') }}</th>
                                            <th class="white-space-nowrap">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $r)
                                            <tr>
                                                <th scope="row">
                                                    {{ $data->currentPage() * (request('row') ? request('row') : 10) - (request('row') ? request('row') : 10) + $loop->iteration }}
                                                </th>
                                                <td>{{ $r->name }}</td>
                                                <td>{{ $r->identity }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('role.edit', encryptor('encrypt', $r->id)) }}"
                                                            class="btn btn-outline-primary btn-sm mx-1"><i
                                                                class="mdi mdi-border-color
                                                                "></i></a>


                                                        <a href="{{ route('permission.list', encryptor('encrypt', $r->id)) }}"
                                                            class="btn btn-outline-primary btn-sm mx-1">
                                                            <i class="mdi mdi-lock-open"></i>
                                                        </a>


                                                        <form
                                                            action="{{ route('role.destroy', encryptor('encrypt', $r->id)) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this record?')">
                                                                <i class="mdi mdi-delete"></i>
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

                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
