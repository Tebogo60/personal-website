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
        Schema::create('about_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_user_id')->constrained('about_users')->onDelete('cascade');
            $table->string('link_name');
            $table->string('link_icon');
            $table->enum('link_type', ['LINK', 'BUTTON']);
            $table->string('link_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_links');
    }
};
