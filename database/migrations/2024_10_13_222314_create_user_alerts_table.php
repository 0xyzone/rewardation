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
        Schema::create('user_alerts', function (Blueprint $table) {
            $table->id();
            $table->string('alert_url')->nullable()->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('message_template')->nullable();
            $table->string('layout')->nullable();
            $table->string('text_animation')->nullable();
            $table->string('alert_animation_1')->nullable();
            $table->string('alert_animation_2')->nullable();
            $table->string('image')->nullable();
            $table->string('sound')->nullable();
            $table->integer('sound_volume')->nullable();
            $table->integer('alert_duration')->nullable();
            $table->integer('alert_delay')->nullable();
            $table->boolean('display_message')->nullable();
            $table->boolean('custom_code_status')->nullable();
            $table->longText('custom_code_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_alerts');
    }
};
