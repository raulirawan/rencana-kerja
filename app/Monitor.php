<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    protected $table = 'monitor';


    public function renaksi()
    {
        return $this->hasMany(Renaksi::class, 'monitor_id', 'id');
    }
}
