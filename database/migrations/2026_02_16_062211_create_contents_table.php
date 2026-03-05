<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sub_category_id')->nullable()->constrained()->nullOnDelete();

            $table->enum('type', ['worksheet', 'coloring_page', 'coloring_book', 'game'])->index();

            $table->string('title');
            $table->string('slug')->unique();

            $table->text('description')->nullable();

            $table->enum('language', ['english', 'hindi', 'urdu'])->nullable()->index();
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->nullable()->index();

            $table->enum('access_type', ['free', 'premium'])->default('free')->index();
            $table->decimal('price', 10, 2)->default(0);

            $table->unsignedBigInteger('download_count')->default(0);

            $table->boolean('is_featured')->default(0);
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
