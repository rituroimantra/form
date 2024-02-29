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
        Schema::create('application_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('post');
            $table->string('wcl');
            $table->string('duration_oil')->nullable();
            $table->string('key_no')->nullable();
            $table->string('employment_exchange')->nullable();
            $table->string('employment_exchange_no')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->string('alternate_mobile')->nullable();
            $table->string('gender');
            $table->string('nationality');
            $table->string('disability');
            $table->string('percentage_Of_disability')->nullable();
            $table->string('type_Of_disability')->nullable();
            $table->string('disability_certificate')->nullable();
            $table->string('disability_date')->nullable();
            $table->string('caste');
            $table->string('caste_certificate')->nullable();
            $table->string('caste_date')->nullable();
            $table->string('non_creamy')->nullable();
            $table->string('non_creamy_certificate')->nullable();
            $table->string('non_creamy_date')->nullable();
            $table->string('ex_servicemen');
            $table->string('ex_servicemen_certificate')->nullable();
            $table->string('ex_servicemen_date')->nullable();
            $table->string('ex_servicemen_period')->nullable();
            $table->string('date_of_birth');
            $table->string('candidate_age');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_form');
    }
};
