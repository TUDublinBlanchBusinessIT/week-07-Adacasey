<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class permissions extends Model
{
    use HasFactory;

    public $table = 'permissions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'name',
        'guard_name'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'guard_name' => 'string'
    ];

    public static $rules = [
        'name' => 'required|string|max:191',
        'guard_name' => 'nullable|string|max:191',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
}