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
        Schema::create('wedding_projects', function (Blueprint $table) {
            $table->id();
            $table->enum('churchMember',['boy','girl','both']);
            $table->foreignUuid('boy_member_id')->nullable()->constrained('members');
            $table->string('boy_name')->nullable();
            $table->string('boy_phone')->nullable();
            $table->string('boy_father_name')->nullable();
            $table->string('boy_mother_name')->nullable();
            $table->foreignId('boy_religion')->nullable()->constrained('predefineds');
            $table->string('boy_religion_certificate')->nullable();
            $table->string('boy_national_id');
            $table->string('boy_aids_certificate');
            $table->string('boy_ceribate_certificate');

            $table->foreignUuid('girl_member_id')->nullable()->constrained('members');
            $table->string('girl_name')->nullable();
            $table->string('girl_phone')->nullable();
            $table->string('girl_father_name')->nullable();
            $table->string('girl_mother_name')->nullable();
            $table->foreignId('girl_religion')->nullable()->constrained('predefineds');
            $table->string('girl_religion_certificate')->nullable();
            $table->string('girl_national_id');
            $table->string('girl_aids_certificate');
            $table->string('girl_ceribate_certificate');

            $table->foreignUuid('region_id')->nullable()->constrained('offices');
            $table->foreignUuid('parish_id')->nullable()->constrained('offices');
            $table->foreignUuid('local_church_id')->nullable()->constrained('offices');
            $table->string('proposedDate');

            $table->foreignUuid('applyBy')->constrained('member_accounts');
            $table->foreignUuid('church')->constrained('offices');
            $table->string('aproovedDate')->nullable();
            $table->foreignUuid('aproovedBy')->nullable()->constrained('users');
            $table->string('rejectedDate')->nullable();
            $table->foreignUuid('rejectedBy')->nullable()->constrained('users');
            $table->text('comment')->nullable();
            $table->enum('status',[1,2,3])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wedding_projects');
    }
};
