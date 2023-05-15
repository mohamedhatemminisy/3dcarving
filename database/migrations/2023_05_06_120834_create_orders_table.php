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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->text('description');
            $table->integer('added_by')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->enum('status', ['created', 'hold','waiting_for_details']);
            $table->string('price')->nullable();;
            $table->enum('pricing_status', ['approved', 'rejected','waiting_for_approval'])->nullable();;
            $table->date('price_approved_at')->nullable();
            $table->integer('designer_id')->unsigned()->nullable();;
            $table->enum('design_status', ['compeleted', 'in_progress','hold','waiting_for_materials'])->nullable();;
            $table->date('design_start_at')->nullable();
            $table->integer('accountant_id')->unsigned()->nullable();;
            $table->date('design_compelete_at')->nullable();
            $table->enum('operation_status', ['compeleted', 'in_progress','hold','in_turn'])->nullable();;
            $table->string('operation_hold_reason')->nullable();;
            $table->integer('machine_type_id')->unsigned()->nullable();;
            $table->integer('machine_id')->unsigned()->nullable();;

            $table->foreign('machine_type_id')->references('id')->on('machine_types')->onDelete('cascade');
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
            $table->foreign('designer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('accountant_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
