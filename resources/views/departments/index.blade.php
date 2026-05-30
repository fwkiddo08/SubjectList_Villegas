@extends('layouts.app')
@section('title', 'Departments')
@section('page-title', 'Departments')

@section('content')
<div class="page-header">
    <div>
        <h1>Departments</h1>
        <p>Manage academic departments and their details.</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="bi bi-plus-lg me-1"></i> Add Department
    </button>
</div>

{{-- Filters --}}
<div class="card mb-3">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('departments.index') }}" class="row g-2 align-items-end">
            <div class="col-12 col-md-5">
                <div class="search-bar">
                    <i class="bi bi-search"></i>
                    <input type="text" name="search" class="form-control"
                        placeholder="Search name, code, head…" value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-6 col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="active"   {{ request('status')=='active'   ? 'selected':'' }}>Active</option>
                    <option value="inactive" {{ request('status')=='inactive' ? 'selected':'' }}>Inactive</option>
                </select>
            </div>
            <div class="col-6 col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x"></i>
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="card">
    <div class="card-header">
        <i class="bi bi-building text-warning me-1"></i> Departments
        <span class="badge bg-warning-subtle text-warning ms-2">{{ $departments->total() }}</span>
    </div>
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['sort'=>'code','dir'=>request('dir')=='asc'?'desc':'asc']) }}"
                            class="text-muted text-decoration-none">Code <i class="bi bi-chevron-expand"></i></a>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['sort'=>'name','dir'=>request('dir')=='asc'?'desc':'asc']) }}"
                            class="text-muted text-decoration-none">Department Name <i class="bi bi-chevron-expand"></i></a>
                    </th>
                    <th>Head / Chair</th>
                    <th>Subjects</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($departments as $i => $dept)
                <tr>
                    <td class="text-muted">{{ $departments->firstItem() + $i }}</td>
                    <td><code>{{ $dept->code }}</code></td>
                    <td>
                        <div class="fw-semibold">{{ $dept->name }}</div>
                        @if($dept->description)
                            <div class="text-muted" style="font-size:12px;max-width:260px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                {{ $dept->description }}
                            </div>
                        @endif
                    </td>
                    <td>{{ $dept->head ?? '—' }}</td>
                    <td>
                        <span class="badge bg-primary-subtle text-primary">
                            {{ $dept->subjects_count }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $dept->status === 'active' ? 'success' : 'danger' }}-subtle
                              text-{{ $dept->status === 'active' ? 'success' : 'danger' }}">
                            {{ ucfirst($dept->status) }}
                        </span>
                    </td>
                    <td class="text-muted" style="font-size:12px">{{ $dept->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-icon btn-outline-primary btn-sm"
                                title="Edit"
                                onclick="openEdit({{ $dept->id }}, @json($dept))">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form id="del-dept-{{ $dept->id }}"
                                action="{{ route('departments.destroy', $dept) }}"
                                method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="button"
                                    class="btn btn-icon btn-outline-danger btn-sm"
                                    title="Delete"
                                    onclick="confirmDelete('del-dept-{{ $dept->id }}', '{{ addslashes($dept->name) }}')">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5">
                        <i class="bi bi-building" style="font-size:40px;color:#cbd5e1;display:block;margin-bottom:8px"></i>
                        <div class="text-muted">No departments found.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($departments->hasPages())
    <div class="card-body pt-0 d-flex justify-content-between align-items-center">
        <span class="text-muted" style="font-size:13px">
            Showing {{ $departments->firstItem() }}–{{ $departments->lastItem() }} of {{ $departments->total() }}
        </span>
        {{ $departments->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('departments.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-plus-circle text-primary me-2"></i>Add Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @include('departments._form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Save Department
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square text-warning me-2"></i>Edit Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @include('departments._form', ['edit' => true])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg me-1"></i> Update Department
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openEdit(id, data) {
    const form = document.getElementById('editForm');
    form.action = `/departments/${id}`;
    form.querySelector('[name=edit_name]').value        = data.name;
    form.querySelector('[name=edit_code]').value        = data.code;
    form.querySelector('[name=edit_description]').value = data.description || '';
    form.querySelector('[name=edit_head]').value        = data.head || '';
    form.querySelector('[name=edit_status]').value      = data.status;
    new bootstrap.Modal(document.getElementById('editModal')).show();
}

@if($errors->any())
    @if(old('edit_name'))
        new bootstrap.Modal(document.getElementById('editModal')).show();
    @else
        new bootstrap.Modal(document.getElementById('addModal')).show();
    @endif
@endif
</script>
@endpush
