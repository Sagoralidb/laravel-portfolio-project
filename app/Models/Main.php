<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','sub_title','bc_image','resume','profile_picture','full_name',
        'profile','email','phone','about_me',
    ];
}
