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
        Schema::create('children_prays', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('applyBy')->constrained('member_accounts');
            $table->string('name');
            $table->string('fatherName');
            $table->string('motherName');
            $table->string('parentPhone');
            $table->enum('gender',[1,2]);
            $table->string('dateOfBirth');
            $table->enum('status',[1,2,3])->default(1);
            $table->foreignUuid('local_church_id')->constrained('offices');
            $table->string('aproovedDate')->nullable();
            $table->foreignUuid('aproovedBy')->nullable()->constrained('users');
            $table->string('rejectedDate')->nullable();
            $table->text('comment')->nullable();
            $table->foreignUuid('rejectedBy')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children_prays');
    }
};
