<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CrfCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'apply_link',
        'parent_id',
    ];

    public function levels(): HasMany
    {
        return $this->hasMany(CrfCourseLevel::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
