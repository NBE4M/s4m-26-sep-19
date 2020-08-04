<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Breaking extends Model
{
    //table name
    protected $table = "breaking_news";
 	protected $primaryKey = 'news_id';
     protected $fillable = ['news_label','news_title','news_url','status'];

}
