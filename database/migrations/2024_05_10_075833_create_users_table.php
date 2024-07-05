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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("username")->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->string("unique_id")->nullable();
            $table->string("avatar")->nullable();
            $table->string("bio")->nullable();
            $table->string("country")->nullable();
            $table->string("company_name")->nullable();
            $table->string("company_type")->nullable();
            $table->string("company_branch")->nullable();
            $table->string("state")->nullable();
            $table->string("city")->nullable();
            $table->string("address")->nullable();
            $table->string("salary")->nullable();
            $table->string("phone")->nullable();
            $table->string("title")->nullable();
            $table->string("bio")->nullable();
            $table->string("education")->nullable();
            $table->string("gender")->nullable();
            $table->boolean("is_verified")->default(false);
            $table->string("role")->default("candidate");
            $table->string("cv")->nullable();
            $table->string("skills")->nullable();
            $table->string("experience")->nullable();
            $table->timestamps();
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
