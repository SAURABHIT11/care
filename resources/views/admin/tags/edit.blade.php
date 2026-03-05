@extends('layouts.admin')

@section('title', 'Edit Tag')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-white py-3 rounded-top-4">
                    <h5 class="mb-0 text-primary fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>
                        Edit Tag
                    </h5>
                </div>

                <div class="card-body p-4">
                    @include('admin.tags.form')
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
