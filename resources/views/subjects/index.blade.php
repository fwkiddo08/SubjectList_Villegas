@extends('layouts.app')
@section('title', 'Subjects')
@section('page-title', 'Subjects')

@section('content')
<div class="page-header">
    <div>
        <h1>Subject List</h1>
        <p>{{ auth()->user()->isStudent() ? 'Browse subjects assigned to your department.' : 'Manage all academic subjects across departments.' }}</p>
    </div>
    @if(auth()->user()->isAdmin())
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-lg me-1"></i> Add Subject
        </button>
    @endif
</div>

{{-- Filters --}}
<div class="card mb-3">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('subjects.index') }}" class="row g-2 align-items-end">
            <div class="col-12 col-md-4">
                <div class="search-bar">
                    <i class="bi bi-search"></i>
                    <input type="text" name="search" class="form-control"
                        placeholder="Search code, name…" value="{{ request('search') }}">
                </div>
            </div>
            @if(auth()->user()->isAdmin())
                <div class="col-6 col-md-2">
                    <select name="department_id" class="form-select">
                        <option value="">All Departments</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>
                                {{ $dept->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @else
                <input type="hidden" name="department_id" value="{{ auth()->user()->department_id }}">
                <div class="col-6 col-md-2">
                    <div class="form-control bg-white text-muted" style="height:44px; display:flex; align-items:center; border:1px solid #d1d5db; border-radius:.375rem;">
                        {{ auth()->user()->department?->name ?? 'Unassigned' }}
                    </div>
                </div>
            @endif
            <div class="col-6 col-md-2">
                <select name="type" class="form-select">
                    <option value="">All Types</option>
                    <option value="lecture"  {{ request('type') == 'lecture'  ? 'selected' : '' }}>Lecture</option>
                    <option value="lab"      {{ request('type') == 'lab'      ? 'selected' : '' }}>Lab</option>
                    <option value="seminar"  {{ request('type') == 'seminar'  ? 'selected' : '' }}>Seminar</option>
                </select>
            </div>
            <div class="col-6 col-md-2">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="active"   {{ request('status') == 'active'   ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-6 col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x"></i>
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-journal-text text-primary me-1"></i> Subjects
            <span class="badge bg-primary-subtle text-primary ms-2">{{ $subjects->total() }}</span>
        </span>
        <div class="d-flex gap-1">
            <a href="{{ request()->fullUrlWithQuery(['sort'=>'name','dir'=> request('dir')=='asc'?'desc':'asc']) }}"
               class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-sort-alpha-down"></i>
            </a>
            <a href="{{ request()->fullUrlWithQuery(['sort'=>'units','dir'=> request('dir')=='asc'?'desc':'asc']) }}"
               class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-123"></i>
            </a>
        </div>
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
                           class="text-muted text-decoration-none">Subject Name <i class="bi bi-chevron-expand"></i></a>
                    </th>
                    <th>Department</th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['sort'=>'units','dir'=>request('dir')=='asc'?'desc':'asc']) }}"
                           class="text-muted text-decoration-none">Units <i class="bi bi-chevron-expand"></i></a>
                    </th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subjects as $i => $subject)
                <tr>
                    <td class="text-muted">{{ $subjects->firstItem() + $i }}</td>
                    <td><code>{{ $subject->code }}</code></td>
                    <td>
                        <div class="fw-semibold">{{ $subject->name }}</div>
                        @if($subject->description)
                            <div class="text-muted" style="font-size:12px;max-width:260px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                {{ $subject->description }}
                            </div>
                        @endif
                    </td>
                    <td>{{ $subject->department?->name ?? '—' }}</td>
                    <td>
                        <span class="fw-semibold">{{ $subject->units }}</span>
                        <span class="text-muted" style="font-size:11px"> unit{{ $subject->units > 1 ? 's' : '' }}</span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $subject->type_badge }}-subtle text-{{ $subject->type_badge }}">
                            {{ ucfirst($subject->type) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $subject->status_badge }}-subtle text-{{ $subject->status_badge }}">
                            {{ ucfirst($subject->status) }}
                        </span>
                    </td>
                    <td class="text-muted" style="font-size:12px">{{ $subject->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('subjects.show', $subject) }}" class="btn btn-icon btn-outline-secondary btn-sm" title="View Details">
                                <i class="bi bi-eye"></i>
                            </a>
                            @if(auth()->user()->isAdmin())
                                <button class="btn btn-icon btn-outline-primary btn-sm"
                                    title="Edit"
                                    onclick='openEdit({{ $subject->id }}, @json($subject))'>
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form id="del-{{ $subject->id }}"
                                    action="{{ route('subjects.destroy', $subject) }}"
                                    method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button type="button"
                                        class="btn btn-icon btn-outline-danger btn-sm"
                                        title="Delete"
                                        onclick="confirmDelete('del-{{ $subject->id }}', '{{ addslashes($subject->name) }}')">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-5">
                        <i class="bi bi-journal-x" style="font-size:40px;color:#cbd5e1;display:block;margin-bottom:8px"></i>
                        <div class="text-muted">No subjects found.</div>
                        @if(request()->hasAny(['search','department_id','type','status']))
                            <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-outline-primary mt-2">Clear Filters</a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($subjects->hasPages())
    <div class="card-body pt-0 d-flex justify-content-between align-items-center">
        <span class="text-muted" style="font-size:13px">
            Showing {{ $subjects->firstItem() }}–{{ $subjects->lastItem() }} of {{ $subjects->total() }} subjects
        </span>
        {{ $subjects->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('subjects.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-plus-circle text-primary me-2"></i>Add New Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @include('subjects._form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Save Subject
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square text-warning me-2"></i>Edit Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @include('subjects._form', ['edit' => true])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg me-1"></i> Update Subject
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
    form.action = `/subjects/${id}`;
    form.querySelector('[name=edit_code]').value        = data.code;
    form.querySelector('[name=edit_name]').value        = data.name;
    form.querySelector('[name=edit_description]').value = data.description || '';
    form.querySelector('[name=edit_units]').value       = data.units;
    form.querySelector('[name=edit_type]').value        = data.type;
    form.querySelector('[name=edit_status]').value      = data.status;
    form.querySelector('[name=edit_department_id]').value = data.department_id || '';
    new bootstrap.Modal(document.getElementById('editModal')).show();
}

// Re-open modal on validation error
@if($errors->any())
    @if(old('edit_code'))
        new bootstrap.Modal(document.getElementById('editModal')).show();
    @else
        new bootstrap.Modal(document.getElementById('addModal')).show();
    @endif
@endif
</script>
@endpush
