<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function students()
    {
      return $this->hasMany(\App\Models\User::class);
    }
}
