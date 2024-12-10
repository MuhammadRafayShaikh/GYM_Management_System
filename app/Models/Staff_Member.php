<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff_Member extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'staff_members';

    public $timestamps = false;
}
