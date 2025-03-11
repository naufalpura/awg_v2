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
        Schema::create('freelancer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agen_id');
            $table->string('number');
            $table->string('name');
            $table->string('gender');
            $table->string('nik');
            $table->longText('address');
            $table->longText('ktp')->nullable();
            $table->longText('mou')->nullable();
            $table->boolean('status')->default(1);

            $table->foreign('agen_id')
                ->references('id')
                ->on('agen')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer');
    }
};
