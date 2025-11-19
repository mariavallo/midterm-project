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
           Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('isbn', 20)->unique();
            $table->string('title', 200);
            $table->string('author', 150);
            $table->string('publisher', 100)->nullable();
            $table->year('publication_year')->nullable();
            $table->string('category', 50)->nullable();
            $table->integer('copies_available')->default(1);
            $table->integer('total_copies')->default(1);
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
