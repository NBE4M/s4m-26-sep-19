<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Tag extends Model
{
    protected $table = 'tags';

    public function Atag()
    {
    return $this->belongsToMany('App\Models\Tag','');
    }
}
?>