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
        Schema::create('callings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('type',['calling','sunday-school-teacher'])->default(1);
            $table->foreignId('category_id')->nullable()->constrained('predefineds');
            $table->enum('status',[1,2])->default(1);
            $table->foreignUuid('member_id')->constrained('members');
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
        Schema::dropIfExists('callings');
    }
};
