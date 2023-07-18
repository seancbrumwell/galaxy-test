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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            // author, a date, a subject, and a body. 
            $table->dateTime('posted_date');
            $table->string('subject', 200); //probably don't need limit, but seemed reasonable
            $table->text('body');
            $table->timestamps();
            $table->foreignId('authors_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
