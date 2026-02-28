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
        Schema::create('page_summary_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_summary_id')
                ->constrained('page_summaries')
                ->onDelete('cascade');
            $table->string('link_name');
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
        Schema::dropIfExists('page_summary_links');
    }
};
