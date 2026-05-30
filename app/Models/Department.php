<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = ['name', 'code', 'description', 'head', 'status'];

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function activeSubjectsCount(): int
    {
        return $this->subjects()->where('status', 'active')->count();
    }
}
