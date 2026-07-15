<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Role extends Model
{
    use HasFactory;
    use NodeTrait;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'parent_id',
    ];
}
