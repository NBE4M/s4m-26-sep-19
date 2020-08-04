<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Mostread extends Model
{
    protected $table = 'article_most_read';

     public function article()
    {
        return $this->belongsTo('App\Models\Article','article_id');
    }

}
?>