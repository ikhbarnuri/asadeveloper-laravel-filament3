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
        Schema::create('student_has_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('home_room_id');
            $table->unsignedBigInteger('periode_id');
            $table->boolean('is_open')
                ->default(true);

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onUpdate('cascade')
                ->onDelete(null);
            $table->foreign('home_room_id')
                ->references('id')
                ->on('home_rooms')
                ->onUpdate('cascade')
                ->onDelete(null);
            $table->foreign('periode_id')
                ->references('id')
                ->on('periodes')
                ->onUpdate('cascade')
                ->onDelete(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_has_classes');
    }
};
