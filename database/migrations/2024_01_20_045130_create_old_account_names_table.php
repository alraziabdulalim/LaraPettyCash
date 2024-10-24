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
        Schema::create('old_account_names', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('s_name', 255)->unique();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('trans_type');

            $table->integer('new_id')->nullable();
            $table->string('new_name', 50)->nullable();
            $table->string('new_name_bn', 255)->nullable();
            $table->string('new_account_group');
            $table->integer('new_parent_id')->nullable();
            $table->string('new_trans_type');

            $table->foreign('parent_id')->references('id')->on('old_account_names')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('old_account_names');
    }
};
