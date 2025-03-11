<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sektor;

class Metabase extends Model
{
    use HasFactory;

    protected $table = 'metabase';
    protected $fillable = ['id_sektor', 'kategori', 'link_metabase', 'keterangan'];

    public function sektor()
    {
        return $this->belongsTo(Sektor::class, 'id_sektor', 'id_sektor');
    }
}
