<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentTypes extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'image',
    ];

    public function Contents()
    {
        return $this->hasMany(Contents::class);
    }

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
