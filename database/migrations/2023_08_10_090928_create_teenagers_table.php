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
        Schema::create('teenagers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('sector_id');
            $table->integer('cell_id');
            $table->integer('village_id');
            $table->enum('gender',[1,2]);
            $table->string('dateOfBirth');
            $table->string('disability')->nullable();
            $table->foreignId('insurance_id')->constrained('predefineds');
            $table->foreignId('saving_id')->nullable()->constrained('predefineds');
            $table->foreignId('education_id')->constrained('predefineds');
            $table->enum('status',[1,2,3])->default(1);
            $table->foreignUuid('region_id')->constrained('offices');
            $table->foreignUuid('parish_id')->constrained('offices');
            $table->foreignUuid('local_church_id')->constrained('offices');
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teenagers');
    }
};
