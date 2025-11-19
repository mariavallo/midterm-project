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
         Schema::create('borrowings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('book_id');
            $table->date('borrowed_date');
            $table->date('due_date');
            $table->date('returned_date')->nullable();
            $table->enum('status', ['borrowed', 'returned', 'overdue'])->default('borrowed');
            $table->decimal('fine_amount', 8, 2)->default(0.00);
            $table->timestamps(); // created_at & updated_at

            // Foreign keys
            $table->foreign('student_id')
                ->references('id')->on('students')
                ->onDelete('cascade');

            $table->foreign('book_id')
                ->references('id')->on('books')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
