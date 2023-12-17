<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('home_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('class_room_id');
            $table->unsignedBigInteger('periode_id');
            $table->boolean('is_open')
                ->default(true);

            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers')
                ->onUpdate('cascade')
                ->onDelete(null);
            $table->foreign('class_room_id')
                ->references('id')
                ->on('class_rooms')
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
        Schema::dropIfExists('home_rooms');
    }
};
