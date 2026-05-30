@extends('layouts.app')
@section('title', 'Subject Details')
@section('page-title', 'Subject Details')

@section('content')
<div class="page-header">
    <div>
        <h1>Subject Details</h1>
        <p class="text-muted">View complete information for this subject.</p>
    </div>
    <div>
        <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Back to Subjects
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row g-4">
            <div class="col-lg-8">
                <h2 class="fw-bold">{{ $subject->name }}</h2>
                <p class="text-muted mb-4">{{ $subject->description ?? 'No description provided.' }}</p>

                <div class="row gy-3">
                    <div class="col-md-6">
                        <div class="detail-label">Subject Code</div>
                        <div class="detail-value">{{ $subject->code }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Units</div>
                        <div class="detail-value">{{ $subject->units }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Department</div>
                        <div class="detail-value">{{ $subject->department?->name ?? '—' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Status</div>
                        <div class="detail-value text-capitalize">{{ $subject->status }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Type</div>
                        <div class="detail-value text-capitalize">{{ $subject->type }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Created On</div>
                        <div class="detail-value">{{ $subject->created_at->format('M d, Y') }}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-light border-light h-100 p-3">
                    <div class="mb-3">
                        <span class="badge bg-primary-subtle text-primary">{{ ucfirst($subject->type) }}</span>
                        <span class="badge bg-{{ $subject->status_badge }}-subtle text-{{ $subject->status_badge }}">{{ ucfirst($subject->status) }}</span>
                    </div>
                    <div class="mb-3">
                        <div class="text-muted">Subject Code</div>
                        <div class="fw-semibold">{{ $subject->code }}</div>
                    </div>
                    <div class="mb-3">
                        <div class="text-muted">Department</div>
                        <div class="fw-semibold">{{ $subject->department?->name ?? '—' }}</div>
                    </div>
                    <div class="mb-3">
                        <div class="text-muted">Units</div>
                        <div class="fw-semibold">{{ $subject->units }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.detail-label { font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: .08em; margin-bottom: .25rem; }
.detail-value { font-size: 16px; }
</style>
@endpush
