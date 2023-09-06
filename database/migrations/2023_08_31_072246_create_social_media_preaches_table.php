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
        Schema::create('social_media_preaches', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('member_id')->constrained('members');
            $table->enum('status',[1,2,3])->default(1);
            $table->string('socialMedia');
            $table->string('motor');
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
        Schema::dropIfExists('social_media_preaches');
    }
};
