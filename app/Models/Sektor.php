<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sektor extends Model
{
    protected $table = 'sektor';
    protected $primaryKey = 'id_sektor';
    public $timestamps = false;
    protected $fillable = ['id_sektor', 'sektor', 'keterangan'];
}
