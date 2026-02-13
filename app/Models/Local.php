<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Local extends Model
{
    use SoftDeletes;

    protected $table = 'locals';

    protected $fillable = [
        'name',
        'image_path',
    ];
}