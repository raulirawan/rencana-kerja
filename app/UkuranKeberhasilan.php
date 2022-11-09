<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UkuranKeberhasilan extends Model
{
    protected $table = 'ukuran_keberhasilan';


    public function renaksi()
    {
        return $this->belongsTo(Renaksi::class, 'rencana_aksi_id', 'id');
    }
}
