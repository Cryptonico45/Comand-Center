<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    protected $table = 'api';
    public $timestamps = false;
    protected $fillable = ['tabel', 'link_api'];
}
