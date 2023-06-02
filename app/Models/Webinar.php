<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
    use HasFactory;
    protected $fillable=[
        'creator_id',
        'title',
        'description',
        'price',
        'video',
        'img'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'creator_id');
    }
}