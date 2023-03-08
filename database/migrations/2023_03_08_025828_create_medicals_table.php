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
        Schema::create('medicals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('student_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->smallInteger('height')->default(0);
            $table->smallInteger('weight')->default(0);
            $table->string('eye_right')->nullable();
            $table->string('eye_left')->nullable();
            $table->string('eye_other')->nullable();
            $table->string('tooth')->nullable();
            $table->string('mouth')->nullable();
            $table->date('check_date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicals');
    }
};
