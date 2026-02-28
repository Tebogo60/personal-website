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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('company_name')->nullable();
            $table->string('position')->nullable();
            $table->string('summary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
