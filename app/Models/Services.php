<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $table = 'services';
    
    protected $fillable = [
        'icon','title','description'
    ];

    public function service_ratings() {
        return $this->hasMany(ServicesRating::class,'services_id')->where('status', 1);
        // return $this->hasMany(ServicesRating::class, 'status', 1);
    }
}
