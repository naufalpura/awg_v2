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
        Schema::create('act_transaction', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('act_sub_category_id');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('bank_id');
            $table->float('nominal');
            $table->string('type');

            $table->foreign('act_sub_category_id')
                ->references('id')
                ->on('act_sub_category')
                ->onDelete('cascade');

            $table->foreign('bank_id')
                ->references('id')
                ->on('bank')
                ->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('act_transaction');
    }
};
