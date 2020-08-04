<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Log extends Model
{
   protected $table = 'events_logs';
   protected $fillable = ['event_date','event_time', 'event_type','userid','description','article_id', 'flag'];

}