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
        Schema::create('newac_names', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('s_name', 500);
            $table->integer('parent_id');
            $table->integer('oldactype_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newac_names');
    }
};
