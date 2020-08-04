<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadFiles extends Model
{
    protected $table = 'fileUpload';
    protected $fillable = ['file_caption','file_name','file_exe','valid'];
}
