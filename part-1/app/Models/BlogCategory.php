<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Validation\Validatesr;

class BlogCategory extends Model
{
    use SoftDeletes;

    protected $fillable
        = [
            'title',
            'slug',
            'parent_id',
            'description',
        ];
}
