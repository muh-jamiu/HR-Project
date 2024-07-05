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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string("job_id")->nullable();
            $table->string("company_id")->nullable();
            $table->string("user_id")->nullable();
            $table->string("username")->nullable();
            $table->string("user_email")->nullable();
            $table->string("user_country")->nullable();
            $table->string("user_city")->nullable();
            $table->string("user_title")->nullable();
            $table->string("user_education")->nullable();
            $table->string("user_portfolio")->nullable();
            $table->string("user_resume")->nullable();
            $table->string("user_state")->nullable();
            $table->string("status")->default("pending");
            $table->boolean("is_close")->default(false);
            $table->string("email")->nullable();
            $table->string("country")->nullable();
            $table->string("avatar")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
