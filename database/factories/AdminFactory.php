<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Admin::class;
    
    public function definition(): array
    {
        return [
            'name' => 'Sagor',
            'email' => 'mdsagorali033@gmail.com',
            'password' => Hash::make('A@126188#'), // পাসওয়ার্ড এনক্রিপ্ট করে সেভ করা হচ্ছে
            // 'email_verified_at' => now(),
            // 'remember_token' => Str::random(10),
        ];
    }
}
