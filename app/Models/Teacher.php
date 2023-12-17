<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'name',
        'address',
        'profile',
    ];

    public function classRoom(): HasMany
    {
        return $this->hasMany(HomeRoom::class, 'teacher_id', 'id');
    }
}
