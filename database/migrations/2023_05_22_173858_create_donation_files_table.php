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
        Schema::create('donation_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file');
            $table->integer('donation_id')->unsigned();
            $table->foreign('donation_id')->references('id')->on('donations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_files');
    }
};
