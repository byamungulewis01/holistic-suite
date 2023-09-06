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
        Schema::create('sunday_school_members', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('sunday_school_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('child_id')->constrained('childrens')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sunday_school_members');
    }
};
