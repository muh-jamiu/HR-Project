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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string("title")->nullable();
            $table->string('description');
            $table->string("company_id")->nullable();
            $table->string("experience")->nullable();
            $table->string("salary")->nullable();
            $table->string("job_type")->nullable();
            $table->string("location")->nullable();
            $table->string("state")->nullable();
            $table->string("city")->nullable();
            $table->string("address")->nullable();
            $table->string("phone")->nullable();
            $table->boolean("is_available")->default(true);
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
        Schema::dropIfExists('jobs');
    }
};
