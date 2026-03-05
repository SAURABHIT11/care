<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('content_files', function (Blueprint $table) {
        $table->string('file_type', 50)->nullable()->change();
    });
}

public function down()
{
    Schema::table('content_files', function (Blueprint $table) {
        $table->string('file_type', 20)->nullable()->change();
    });
}
};
