@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb d-flex align-center justify-content-between">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Admin List Table</li>
            </ol>
            <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">Create
               Slider</a>
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
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($sliders as $slider)
                                        <tr>
                                            <td>{{ $slider->id }}</td>
                                            <td>{{ $slider->slider_title }}</td>
                                            <td>
                                                {!! Str::limit(strip_tags($slider->description), 30, '...') !!}
                                            </td>
                                            <td>
                                                <img src="{{ asset($slider->image) }}" alt="">
                                            </td>
                                            <td>{{ $slider->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                @if ($slider->status === 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-primary">De Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <a href="{{ route('admin.slider.edit', $slider->id) }}"
                                                        class="btn btn-primary btn-icon">

                                                        <i data-feather="edit"></i></a>


                                                    @if (Auth::user()->role_id === 1)
                                                        <form id="delete_form_{{ $slider->id }}"
                                                            action="{{ route('admin.slider.destroy', $slider->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                        <button type="button" class="btn btn-danger btn-icon delete-button"
                                                        onclick="deleteId({{ $slider->id }})">
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
