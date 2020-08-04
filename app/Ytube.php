<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Ytube extends Model
{
   protected $table = 'youtubevideo';
   protected $fillable = ['title','vid','img_thumb','publish_date'];

}