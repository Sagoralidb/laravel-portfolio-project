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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description');
            $table->string('clint')->nullable();
            $table->string('project_url')->nullable();
            $table->string('tags')->nullable();
            $table->enum('status', ['1', '0'])->default('1');
            $table->enum('showHome', ['Yes', 'No'])->default('No');
            $table->enum('post_type', ['project', 'blog'])->default('blog');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->timestamps();
        });
        
    }
    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
