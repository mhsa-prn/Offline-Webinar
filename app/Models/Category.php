<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;

class Category extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'parent_id'
    ];

    public function parent()
    {
        return Category::where('id',$this->parent_id)->first();
    }


}
