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
       Schema::create('blogs', function (Blueprint $table) {

    $table->id();

    // 🔗 Relations
    $table->foreignId('category_id')
          ->nullable()
          ->constrained('categories')
          ->nullOnDelete();

    $table->foreignId('user_id')
          ->nullable()
          ->constrained('users')
          ->nullOnDelete();

    // 📝 Core Content
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('excerpt')->nullable();
    $table->longText('content');

    // 🤖 AI Related
    $table->text('prompt')->nullable();
    $table->string('tone')->nullable();
    $table->integer('word_count')->nullable();
    $table->json('keywords')->nullable();
    $table->string('ai_model')->nullable(); // gemini-1.5-pro etc
    $table->decimal('temperature', 3, 2)->nullable();

    // 🖼 Media
    $table->string('featured_image')->nullable();
    $table->string('featured_image_alt')->nullable();

    // 📊 SEO
    $table->string('meta_title')->nullable();
    $table->text('meta_description')->nullable();
    $table->json('meta_keywords')->nullable();

    // 🚦 Publishing
    $table->enum('status', ['draft', 'review', 'scheduled', 'published'])
          ->default('draft');

    $table->timestamp('published_at')->nullable();
    $table->timestamp('scheduled_at')->nullable();

    // 📈 Analytics
    $table->unsignedBigInteger('views')->default(0);
    $table->unsignedBigInteger('likes')->default(0);

    // 🏷 Flags
    $table->boolean('is_featured')->default(false);
    $table->boolean('is_ai_generated')->default(true);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
