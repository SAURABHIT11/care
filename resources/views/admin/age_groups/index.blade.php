@extends('layouts.admin')

@section('title', 'Age Groups')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary mb-0">
            <i class="bi bi-people me-2"></i> Age Groups
        </h4>

        <a href="{{ route('admin.age-groups.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-circle me-1"></i> Add Age Group
        </a>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-white py-3 rounded-top-4">
            <h6 class="mb-0 fw-bold text-dark">
                <i class="bi bi-list-ul me-2"></i> All Age Groups
            </h6>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:70px;">#</th>
                            <th>Age Group</th>
                            <th>Slug</th>
                            <th style="width:120px;">Sort</th>
                            <th style="width:120px;">Status</th>
                            <th style="width:180px;" class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($ageGroups as $key => $ageGroup)
                            <tr>
                                <td class="text-muted">
                                    {{ $ageGroups->firstItem() + $key }}
                                </td>

                                <td>
                                    <div class="fw-bold">{{ $ageGroup->name }}</div>
                                    <div class="small text-muted">ID: {{ $ageGroup->id }}</div>
                                </td>

                                <td>
                                    <code>{{ $ageGroup->slug }}</code>
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $ageGroup->sort_order }}
                                    </span>
                                </td>

                                <td>
                                    @if($ageGroup->status)
                                        <span class="badge bg-success">
                                            <i class="bi bi-eye me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="bi bi-eye-slash me-1"></i> Hidden
                                        </span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('admin.age-groups.show', $ageGroup->id) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.age-groups.edit', $ageGroup->id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('admin.age-groups.destroy', $ageGroup->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this age group?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-folder-x fs-2 d-block mb-2"></i>
                                        No Age Groups Found
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($ageGroups->hasPages())
            <div class="card-footer bg-white py-3 rounded-bottom-4">
                {{ $ageGroups->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
