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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('account_name_id');
            $table->unsignedBigInteger('old_account_name_id')->nullable();
            $table->string('trans_type');
            $table->integer('amount');
            $table->text('details');
            $table->timestamp('voucher_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('account_name_id')->references('id')->on('account_names')->onDelete('cascade');
            $table->foreign('old_account_name_id')->references('id')->on('old_account_names')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
