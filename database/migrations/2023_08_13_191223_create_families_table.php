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
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('family_id')->constrained('members')->cascadeOnDelete();
            $table->foreignUuid('member_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignUuid('child_id')->nullable()->constrained('childrens')->cascadeOnDelete();
            $table->enum('relation', ['head', 'spouse', 'child','other']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};
