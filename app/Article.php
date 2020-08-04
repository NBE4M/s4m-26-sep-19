<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $primaryKey = 'article_id';
    protected $fillable = [
        'title',
        'body'        
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function rights()
    {
        return $this->belongsToMany('App\Right');
    }
     public function mostread()
    {
        return $this->hasOne('App\Mostread');
    }
     public function authors()
    {
        return $this->hasMany('App\Aauthor');
    }
}
