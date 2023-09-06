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
        Schema::create('class_members', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('class_id')->nullable()->constrained('class_steps')->cascadeOnDelete();
            $table->foreignUuid('penitent_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignUuid('teenager_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignUuid('friend_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignUuid('member_id')->nullable()->constrained()->cascadeOnDelete();
            $table->enum('from', [1,2,3])->nullable();
            $table->enum('type', ['baptism','others']);
            $table->enum('status', [1,2,3])->default(1)->comment('1:start, 2:left, 3:end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_members');
    }
};
