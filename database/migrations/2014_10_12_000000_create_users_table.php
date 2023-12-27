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
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->unsignedBigInteger('role_id');
      $table
        ->foreign('role_id')
        ->references('id')
        ->on('roles');
      $table->string('email');
      $table->string('mobile');
      $table->boolean('status');
      $table->unsignedBigInteger('default_language_id')->nullable();
      $table
        ->foreign('default_language_id')
        ->references('id')
        ->on('languages');
      $table->string('password');
      $table->string('image_path')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
