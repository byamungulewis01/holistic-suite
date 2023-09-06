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
        Schema::create('sunday_schools', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('classIndex');
            $table->foreignUuid('teacher_id')->constrained('members')->cascadeOnDelete();
            $table->string('class');
            $table->integer('level');
            $table->enum('status',[1,2])->default(1);
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
        Schema::dropIfExists('sunday_schools');
    }
};
