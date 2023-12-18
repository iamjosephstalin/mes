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
        Schema::create('machines_operations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('name');
            $table->boolean('active')->default(0)->comment('active');
            $table->boolean('end_machine')->default(0)->comment('end machine');
            $table->integer('work_hour_price')->default(0)->comment('work hour price');
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('no_of_shifts')->default(0)->comment('number of shifts');
            $table->integer('hours_per_pay')->default(0)->comment('hours per pay');
            $table->longText('notes')->nullable()->comment('notes');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines_operations');
    }
};
