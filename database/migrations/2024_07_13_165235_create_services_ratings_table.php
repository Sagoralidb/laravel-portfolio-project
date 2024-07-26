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
        Schema::create('services_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('services_id')->constrained('services')->onDelete('cascade');
            $table->foreignId('portfolio_id')->nullable()->constrained('portfolios')->onDelete('cascade');
            $table->string('comment', 1000)->change(); 
            $table->double('rating',3,2); 
            $table->integer('status')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_ratings');
    }
};
