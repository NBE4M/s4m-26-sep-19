<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mostread extends Model
{
    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
     
}
