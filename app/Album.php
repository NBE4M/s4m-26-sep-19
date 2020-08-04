<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Album extends Model
{
    //table name
    protected $table = "album";
 	protected $primaryKey = 'id';
    public function photo()
    {
        return $this->hasMany('App\Photo','owner_id');
    }

}
