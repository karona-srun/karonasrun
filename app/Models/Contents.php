<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    use HasFactory;


    public function contentType()
    {
        return $this->belongsTo(ContentTypes::class,'content_type_id'); 
    }
}
