<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Subscribenewsletter extends Model
{
    protected $table = 'subscribe_newsletter';
    protected $fillable = ['email'];

}
?>