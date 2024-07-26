<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'project_cost',
        'payment_type',
        'amount',
        'pay_method',
        'tranjection_id',
        'status',
    ];
}
