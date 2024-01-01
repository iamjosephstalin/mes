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
    Schema::create('clock_pause_history', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('clock_history_id');
      $table
        ->foreign('clock_history_id')
        ->references('id')
        ->on('clock_history');
      $table->timestamp('pause_start');
      $table->timestamp('pause_stop')->nullable(true);
      $table->string('pause_time')->nullable(true);
      $table->string('reason')->nullable(true);
      $table->string('comment')->nullable(true);
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('clock_pause_history');
  }
};
