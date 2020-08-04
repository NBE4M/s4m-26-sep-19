<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Photo extends Model
{
    protected $table = 'photos';
    protected $fillable = ['title','description','photopath','owned_by','owner_id','active','valid'];

}
?>