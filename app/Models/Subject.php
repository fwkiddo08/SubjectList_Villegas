<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subject extends Model
{
    protected $fillable = ['code', 'name', 'description', 'units', 'type', 'status', 'department_id'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function getTypeBadgeAttribute(): string
    {
        return match ($this->type) {
            'lecture' => 'primary',
            'lab'     => 'success',
            'seminar' => 'warning',
            default   => 'secondary',
        };
    }

    public function getStatusBadgeAttribute(): string
    {
        return $this->status === 'active' ? 'success' : 'danger';
    }
}
