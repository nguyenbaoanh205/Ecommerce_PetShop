<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'category_id',
        'title',
        'content',
        'slug',
        'description',
        'status',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
