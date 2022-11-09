<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';


    public function sasaranStrategis()
    {
        return $this->belongsTo(SasaranStrategis::class, 'sasaran_id', 'id');
    }

    public function monitor()
    {
        return $this->belongsTo(Monitor::class, 'monitor_id', 'id');
    }
}
