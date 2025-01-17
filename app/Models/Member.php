<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function memberMembership()
    {
        return $this->belongsTo(Membership::class, 'membership');
    }
}
