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
        Schema::create('account_names', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('name_bn', 255)->unique();
            $table->string('account_group');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('trans_type');

            $table->integer('old_id')->nullable();
            $table->string('old_name', 255)->nullable();
            $table->integer('old_parent_id')->nullable();
            $table->string('old_trans_type')->nullable();

            $table->foreign('parent_id')->references('id')->on('account_names')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_names');
    }
};
