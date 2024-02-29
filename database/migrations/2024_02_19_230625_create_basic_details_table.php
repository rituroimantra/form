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
        Schema::create('basic_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('father');
            $table->string('mother');
            $table->enum('marital_status', ['Married', 'Unmarried']);
            $table->string('permanent_pin_code');
            $table->string('permanent_city');
            $table->string('permanent_state');
            $table->string('permanent_address_one');
            $table->string('permanent_address_two')->nullable();
            $table->string('correspondence_pin_code');
            $table->string('correspondence_city');
            $table->string('correspondence_state');
            $table->string('correspondence_address_one');
            $table->string('correspondence_address_two')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basic_details');
    }
};