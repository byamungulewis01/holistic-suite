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
        Schema::create('member_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reg_no')->unique();
            $table->string('password');
            $table->string('verification_code')->nullable();
            $table->boolean('verified')->default(false);
            $table->boolean('passwordChanged')->default(false);
            $table->foreignUuid('member_id')->constrained('members');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_accounts');
    }
};
