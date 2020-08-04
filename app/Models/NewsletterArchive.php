<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class NewsletterArchive extends Model
{
    protected $table = 'newsletter_archive';
    protected $fillable = ['newsletter_name','filename','published_date','newsletter_id'];
}
?>