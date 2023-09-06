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
        Schema::create('predefineds', function (Blueprint $table) {
            $table->id();
            $table->string('english');
            $table->string('kinyarwanda');
            $table->enum('type',['ministry','education','field','medical_insurance','saving_type','relation','status','marital_status','childrenEducation','service','religion','calling','step','commission']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predefineds');
    }
};
