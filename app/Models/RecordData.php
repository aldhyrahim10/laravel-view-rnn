<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecordData extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'attachment',
    ];
}
