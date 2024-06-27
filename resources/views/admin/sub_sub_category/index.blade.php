@extends('admin.layouts.master')

@section('content')

    <div class="page-content">
        <nav class="page-breadcrumb d-flex align-center justify-content-between">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sub Category List Table</li>
            </ol>
            <a href="{{ route('admin.sub_sub_category.create') }}" class="btn btn-primary"> Create
                Sub Sub Category</a>
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

                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Name</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($sub_sub_categories as $sub_sub_category)
                                        <tr>
                                            <td>{{ $sub_sub_category->id }}</td>
                                            <td>
                                                @if ($sub_sub_category->category)
                                                    {{ $sub_sub_category->category->name }}
                                                @else
                                                    No Category
                                                @endif
                                            </td>
                                            <td>
                                                @if ($sub_sub_category->sub_category)
                                                    {{ $sub_sub_category->sub_category->name }}
                                                @else
                                                    No Category
                                                @endif
                                            </td>
                                            <td>{{ $sub_sub_category->name }}</td>
                                            <td>{{ $sub_sub_category->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                @if ($sub_sub_category->status === 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-primary">De Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <a href="{{ route('admin.sub_sub_category.edit', $sub_sub_category->id) }}"
                                                        class="btn btn-primary btn-icon">

                                                        <i data-feather="edit"></i></a>

                                                    @if (Auth::user()->role_id === 1)
                                                        <form id="delete_form_{{ $sub_sub_category->id }}"
                                                            action="{{ route('admin.sub_sub_category.destroy', $sub_sub_category->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                        <button type="button" class="btn btn-danger btn-icon delete-button"
                                                            onclick="deleteId({{ $sub_sub_category->id }})">
                                                            <i data-feather="trash"></i>
                                                        </button>
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
