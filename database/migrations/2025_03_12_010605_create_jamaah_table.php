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
        Schema::create('jamaah', function (Blueprint $table) {
            $table->id();
            $table->date('register_date');
            $table->string('number');
            $table->string('phone');
            $table->string('name');
            $table->string('gender');
            $table->string('nik');
            $table->unsignedBigInteger('packet_umroh_id');
            $table->float('nominal');
            $table->unsignedBigInteger('mitra_id');
            $table->unsignedBigInteger('agen_id');
            $table->unsignedBigInteger('freelancer_id');
            $table->longText('form')->nullable();
            $table->longText('akad')->nullable();
            $table->longText('proof')->nullable();
            $table->longText('ktp')->nullable();

            $table->boolean('status')->default(1);
            $table->longtext('description')->nullable();

            $table->foreign('packet_umroh_id')
                ->references('id')
                ->on('packet_umroh')
                ->onDelete('cascade');
            $table->foreign('mitra_id')
                ->references('id')
                ->on('mitra')
                ->onDelete('cascade');
            $table->foreign('agen_id')
                ->references('id')
                ->on('agen')
                ->onDelete('cascade');
            $table->foreign('freelancer_id')
                ->references('id')
                ->on('freelancer')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jamaah');
    }
};
