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
        Schema::create('choir_move_requests', function (Blueprint $table) {
            $table->id();
            $table->string('choirName');
            $table->foreignUuid('member_id')->constrained('members');
            $table->enum('status',[1,2,3])->default(1);
            $table->string('date');
            $table->enum('places',[1,2,3]);
            $table->foreignUuid('region_id')->nullable()->constrained('offices');
            $table->foreignUuid('parish_id')->nullable()->constrained('offices');
            $table->foreignUuid('local_church_id')->nullable()->constrained('offices');
            $table->string('elseWhere')->nullable();
            $table->string('abroad')->nullable();
            $table->foreignUuid('applyBy')->constrained('member_accounts');
            $table->foreignUuid('church')->constrained('offices');
            $table->string('aproovedDate')->nullable();
            $table->foreignUuid('aproovedBy')->nullable()->constrained('users');
            $table->string('rejectedDate')->nullable();
            $table->foreignUuid('rejectedBy')->nullable()->constrained('users');
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choir_move_requests');
    }
};