<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 */
class Guest extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'first_name' ,
        'last_name',
        'email',
        'phone',
        'country',
    ];
}
