<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('book_id')
                  ->constrained('books')
                  ->cascadeOnDelete();

            $table->dateTime('borrowed_at');          
            $table->dateTime('due_at');               
            $table->dateTime('returned_at')->nullable(); 

            $table->enum('status', ['borrowed', 'returned', 'late'])
                  ->default('borrowed');

            $table->decimal('penalty_amount', 8, 2)
                  ->default(0);

            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
