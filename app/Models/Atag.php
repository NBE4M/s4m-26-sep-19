<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Atag extends Model
{
    protected $table = 'article_tags';

     public function tags()
    {
    return $this->hasOne('App\Models\Tag','tags_id','tags_id');
    }

}
?>