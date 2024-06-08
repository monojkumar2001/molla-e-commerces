@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb d-flex align-center justify-content-between">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Admin List Table</li>
            </ol>
            <a href="{{ route('admin.category.create') }}" class="btn btn-primary"> <i data-feather="user-plus"></i> Create
                Admin</a>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Admin List Table</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        @foreach ($categories as $category)
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>

                                                {{ $category->description }}
                                            </td>
                                            <td>
                                                <img src="{{ asset($category->image) }}" alt="">
                                            </td>
                                            <td>
                                                @if ($category->status === 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-primary">De Active</span>

                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.category.edit', $category->id) }}"
                                                    class="btn btn-primary btn-icon">

                                                    <i data-feather="edit"></i></a>

                                                @if (Auth::user()->role_id === 1)
                                                    <form action="{{ route('admin.category.destroy', $category->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-icon delete-button"
                                                            onclick="deleteId({{ $category->id }})">
                                                            <i data-feather="trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                         
                                        @endforeach
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
