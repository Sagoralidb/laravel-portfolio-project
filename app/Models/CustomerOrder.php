<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id','title','description','status','budget'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}