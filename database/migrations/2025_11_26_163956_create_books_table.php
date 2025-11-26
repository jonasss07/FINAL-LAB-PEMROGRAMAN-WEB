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
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // Untuk URL yang cantik
            $table->string('author');
            $table->string('publisher');
            $table->year('publication_year');
            $table->string('category'); // Bisa dibuat tabel terpisah jika ingin kompleks
            $table->text('description')->nullable();
            $table->integer('stock');
            $table->integer('max_loan_days')->default(7); // Default pinjam 7 hari
            $table->decimal('fine_per_day', 10, 2)->default(1000); // Denda per hari
            $table->string('cover_image')->nullable();
            $table->timestamps();
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
