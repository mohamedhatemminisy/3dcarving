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
        Schema::create('donations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('collection_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('price')->nullable();
            $table->string('address')->nullable();
            $table->integer('added_by')->unsigned();
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
            $table->integer('donator_id')->unsigned();
            $table->foreign('donator_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('party_id')->unsigned();
            $table->foreign('party_id')->references('id')->on('parties')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
