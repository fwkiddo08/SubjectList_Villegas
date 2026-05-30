@php $edit = $edit ?? false; $p = $edit ? 'edit_' : ''; @endphp

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">Subject Code <span class="text-danger">*</span></label>
        <input type="text" name="{{ $p }}code" class="form-control @error($p.'code') is-invalid @enderror"
            placeholder="e.g. CS101"
            value="{{ old($p.'code') }}" required maxlength="20"
            style="text-transform:uppercase" oninput="this.value=this.value.toUpperCase()">
        @error($p.'code')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-8">
        <label class="form-label">Subject Name <span class="text-danger">*</span></label>
        <input type="text" name="{{ $p }}name" class="form-control @error($p.'name') is-invalid @enderror"
            placeholder="e.g. Introduction to Programming"
            value="{{ old($p.'name') }}" required>
        @error($p.'name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="{{ $p }}description" class="form-control" rows="2"
            placeholder="Brief description of the subject…">{{ old($p.'description') }}</textarea>
    </div>
    <div class="col-md-3">
        <label class="form-label">Units <span class="text-danger">*</span></label>
        <input type="number" name="{{ $p }}units" class="form-control @error($p.'units') is-invalid @enderror"
            min="1" max="10" placeholder="3"
            value="{{ old($p.'units', 3) }}" required>
        @error($p.'units')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Type <span class="text-danger">*</span></label>
        <select name="{{ $p }}type" class="form-select @error($p.'type') is-invalid @enderror" required>
            <option value="lecture" {{ old($p.'type','lecture') == 'lecture' ? 'selected' : '' }}>Lecture</option>
            <option value="lab"     {{ old($p.'type') == 'lab'     ? 'selected' : '' }}>Laboratory</option>
            <option value="seminar" {{ old($p.'type') == 'seminar' ? 'selected' : '' }}>Seminar</option>
        </select>
        @error($p.'type')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="{{ $p }}status" class="form-select @error($p.'status') is-invalid @enderror" required>
            <option value="active"   {{ old($p.'status','active') == 'active'   ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old($p.'status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error($p.'status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Department</label>
        <select name="{{ $p }}department_id" class="form-select">
            <option value="">— None —</option>
            @foreach($departments as $dept)
                <option value="{{ $dept->id }}" {{ old($p.'department_id') == $dept->id ? 'selected' : '' }}>
                    {{ $dept->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
