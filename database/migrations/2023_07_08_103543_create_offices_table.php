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
        Schema::create('offices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->enum('type', ['region', 'parish', 'local-church']);
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('sector_id');
            $table->integer('cell_id');
            $table->integer('village_id');
            $table->bigInteger('reg_number')->unique();
            $table->integer('region_number')->nullable();
            $table->integer('parish_number')->nullable();
            $table->integer('local_church_number')->nullable();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->bigInteger('wedding_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offices');
    }
};
