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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('name');
            $table->boolean('active')->default(0)->comment('active');
            $table->string('address')->nullable()->comment('address');
            $table->string('tax_id_number')->nullable()->comment('tax_id_number');
            $table->string('city')->nullable()->comment('city');
            $table->string('email')->nullable()->comment('email');
            $table->string('phone')->nullable()->comment('phone');
            $table->string('postal_code')->nullable()->comment('postal_code');
            $table->string('web_page')->nullable()->comment('web_page');
            $table->longText('comment')->nullable()->comment('comment');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
