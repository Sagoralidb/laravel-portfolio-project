<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    // protected $table = 'portfolios';

    protected $fillable = [
        'title', 'slug', 'short_description', 'description', 'related_products', 
        'clint', 'project_url', 'category_id', 'tags', 'status', 'showHome', 'post_type',
    ];

    public function getTagsArrayAttribute()
    {
        return explode(',', $this->tags);
    }
    public function images()
    {
        return $this->hasMany(Gallery::class, 'portfolio_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
}
