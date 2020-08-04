<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table ='tbl_menu';
    protected $primaryKey = 'id';

    public function parent()
    {
        return $this->belongsTo('App\Menu', 'parent_id');
    }
 
    public function children()
    {
        return $this->hasMany('App\Menu', 'parent_id')->where('active','1')->orderBy('ordering');
    }

}