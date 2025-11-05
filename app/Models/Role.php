<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;

    protected $table = 'roles';

    protected $primaryKey = 'role_id';

    public $timestamps = false;

    protected $fillable = [
        'role_name',
        'is_deleted'
    ];
    
}
