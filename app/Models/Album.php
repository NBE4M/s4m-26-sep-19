<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Album extends Model
{
    protected $table = 'album';
     public function photos()
    {
         return $this->hasMany('App\Models\Photo','owner_id');
    }
}
?>