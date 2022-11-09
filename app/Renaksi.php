<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renaksi extends Model
{
    protected $table = 'rencana_aksi';


    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'skpd_id', 'id');
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id', 'id');
    }

    public function kriteria()
    {
        return $this->hasMany(Kriteria::class, 'rencana_aksi_id', 'id');
    }

    public function ukuran()
    {
        return $this->hasMany(UkuranKeberhasilan::class, 'rencana_aksi_id', 'id');
    }
}
