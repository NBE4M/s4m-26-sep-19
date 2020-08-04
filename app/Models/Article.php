<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Article extends Model
{
    protected $table = 'article';
     protected $primaryKey = 'article_id';
     public $timestamps = false;

    public function mostread()
    {
        return $this->hasOne('App\Models\Mostread', 'article_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category','category_id','category_id');
    }
    public function authors()
    {
        return $this->belongsTo('App\Models\Author','author_type','author_type_id');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\Author','author_id','author_id');
    }

    public function albums()
    {
         return $this->hasMany('App\Models\Album','id','album_id');
    }

    public function Atag()
    {
    return $this->hasMany('App\Models\Atag','article_id','article_id');
    }

    public function Masternewsletter()
    {
    return $this->hasOne('App\Models\Masternewsletter','article_id','article_id');
    }

   

}
?>