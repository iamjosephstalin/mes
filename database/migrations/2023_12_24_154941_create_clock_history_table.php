<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('clock_history', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table
        ->foreign('user_id')
        ->references('id')
        ->on('users');
      $table->timestamp('clock_in');
      $table->timestamp('clock_out')->nullable(true);
      $table->string('working_time')->nullable(true);
      $table->string('pause_time')->nullable(true);
      $table->boolean('in_pause')->default(false);
      $table->boolean('in_work')->default(false);
      $table->integer('number_of_pauses')->nullable(true);
      $table->string('clock_in_comment')->nullable(true);
      $table->string('clock_out_comment')->nullable(true);
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('clock_history');
  }
};
