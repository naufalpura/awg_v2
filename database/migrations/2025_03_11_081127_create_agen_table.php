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
        Schema::create('agen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mitra_id');
            $table->string('number');
            $table->string('name');
            $table->string('gender');
            $table->string('nik');
            $table->longText('address');
            $table->longText('ktp')->nullable();
            $table->longText('mou')->nullable();
            $table->boolean('status')->default(1);

            $table->foreign('mitra_id')
                ->references('id')
                ->on('mitra')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agen');
    }
};
