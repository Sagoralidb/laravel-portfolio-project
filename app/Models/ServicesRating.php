<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesRating extends Model
{
    use HasFactory;

    protected $table = 'services_ratings';

    protected $fillable = [
        'user_id',
        'services_id',
        'portfolio_id',
        'comment',
        'rating',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function service() {
        return $this->belongsTo(Services::class, 'services_id');
    }
}

