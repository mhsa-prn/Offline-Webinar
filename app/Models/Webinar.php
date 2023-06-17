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
        'img',
        'confirmed',
        'category_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'creator_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
