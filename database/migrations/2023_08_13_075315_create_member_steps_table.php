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
        Schema::create('member_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('member_id')->constrained()->cascadeOnDelete();
            $table->enum('step', ['childPrayer', 'baptism', 'mariage']);
            $table->string('date');
            $table->string('spouse_name')->nullable();
            $table->foreignUuid('region_id')->constrained('offices');
            $table->foreignUuid('parish_id')->constrained('offices');
            $table->foreignUuid('local_church_id')->constrained('offices');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_steps');
    }
};
