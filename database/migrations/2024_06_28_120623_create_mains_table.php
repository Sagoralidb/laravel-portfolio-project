<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mains', function (Blueprint $table) {
            $table->id();
            $table->string('title');        
            $table->string('sub_title');    
            $table->string('bc_image');     
            $table->string('profile_picture');
            $table->string('resume');       
            $table->string('full_name')->nullable();
            $table->string('profile')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->longText('about_me')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mains');
    }
};
