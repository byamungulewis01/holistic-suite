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
        Schema::create('members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('reg_no')->unique();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('nid')->nullable()->unique();
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('sector_id');
            $table->integer('cell_id');
            $table->integer('village_id');
            $table->enum('gender',[1,2]);
            $table->string('dateOfBirth');
            $table->string('disability')->nullable();
            $table->string('training')->nullable();
            $table->string('professional')->nullable();
            $table->string('employer')->nullable();
            $table->foreignId('insurance_id')->constrained('predefineds');
            $table->foreignId('saving_id')->nullable()->constrained('predefineds');
            $table->foreignId('marital_status_id')->constrained('predefineds');
            $table->foreignId('education_id')->constrained('predefineds');
            $table->string('field_id')->nullable();
            $table->string('ministry_id');
            $table->enum('relation',[1,2,3,4]);
            $table->enum('status',[1,2,3,4]);
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('members');
    }
};
