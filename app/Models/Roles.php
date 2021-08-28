<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    const IS_ADMIN = 1;
    const IS_MANAGER = 2;
    const IS_USER = 3;
}
