@php $edit = $edit ?? false; $p = $edit ? 'edit_' : ''; @endphp

<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Department Name <span class="text-danger">*</span></label>
        <input type="text" name="{{ $p }}name"
            class="form-control @error($p.'name') is-invalid @enderror"
            placeholder="e.g. Computer Science"
            value="{{ old($p.'name') }}" required>
        @error($p.'name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Code <span class="text-danger">*</span></label>
        <input type="text" name="{{ $p }}code"
            class="form-control @error($p.'code') is-invalid @enderror"
            placeholder="e.g. CS"
            value="{{ old($p.'code') }}" required maxlength="20"
            style="text-transform:uppercase" oninput="this.value=this.value.toUpperCase()">
        @error($p.'code')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="{{ $p }}description" class="form-control" rows="2"
            placeholder="Brief description…">{{ old($p.'description') }}</textarea>
    </div>
    <div class="col-md-8">
        <label class="form-label">Department Head / Chair</label>
        <input type="text" name="{{ $p }}head" class="form-control"
            placeholder="e.g. Dr. Jose Reyes" value="{{ old($p.'head') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="{{ $p }}status" class="form-select" required>
            <option value="active"   {{ old($p.'status','active') == 'active'   ? 'selected':'' }}>Active</option>
            <option value="inactive" {{ old($p.'status') == 'inactive' ? 'selected':'' }}>Inactive</option>
        </select>
    </div>
</div>
