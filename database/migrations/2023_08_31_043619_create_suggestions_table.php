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
        Schema::create('suggestions', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('member_id')->constrained('members');
            $table->enum('type',[1,2,3]);
            $table->enum('status',[1,2])->default(1);
            $table->text('description');
            $table->text('reply')->nullable();
            $table->foreignUuid('repliedBy')->nullable()->constrained('users');
            $table->foreignUuid('applyBy')->constrained('member_accounts');
            $table->foreignUuid('local_church_id')->constrained('offices');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suggestions');
    }
};
