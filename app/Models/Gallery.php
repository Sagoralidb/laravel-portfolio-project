<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table ='galleries';
    protected $fillable = ['portfolio_id','images'];
    
    // public function portfolio()
    // {
    //     return $this->hasMany(Portfolio::class);
    // }
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class, 'portfolio_id');
    }
}
