<?php

namespace App\Models;

use App\Traits\UUIDGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use UUIDGenerator;

    protected $guarded = [];
    protected $primaryKey = 'uuid';
}
