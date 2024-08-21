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
        Schema::create('bookings', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mentor_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->date('day');
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('amount');
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->string('payment_status')->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
