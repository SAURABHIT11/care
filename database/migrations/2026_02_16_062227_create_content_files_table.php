<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('content_files', function (Blueprint $table) {
            $table->id();

            $table->foreignId('content_id')->constrained()->cascadeOnDelete();

            $table->enum('file_type', ['pdf', 'image', 'zip', 'game_url'])->index();

            $table->string('file_path'); // storage path OR url for game_url
            $table->string('preview_image')->nullable(); // optional preview

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_files');
    }
};
