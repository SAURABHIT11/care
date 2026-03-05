<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('content_age_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')->constrained()->cascadeOnDelete();
            $table->foreignId('age_group_id')->constrained()->cascadeOnDelete();

            $table->unique(['content_id', 'age_group_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_age_group');
    }
};
