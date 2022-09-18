<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'content_type_id', 'name', 'youtubeId', 'youtubeLink'
    ];

    public function contentType()
    {
        return $this->belongsTo(ContentTypes::class,'content_type_id'); 
    }

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'content_type_id'
    ];

}
