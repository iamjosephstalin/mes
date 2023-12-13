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
    Schema::create('roles', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->unsignedBigInteger('user_type_id');
      $table
        ->foreign('user_type_id')
        ->references('id')
        ->on('user_types');
      $table->timestamps();
      $table->unsignedBigInteger('created_by');
      $table
        ->foreign('created_by')
        ->references('id')
        ->on('users');
      $table->unsignedBigInteger('updated_by');
      $table
        ->foreign('updated_by')
        ->references('id')
        ->on('users');
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('roles');
  }
};
