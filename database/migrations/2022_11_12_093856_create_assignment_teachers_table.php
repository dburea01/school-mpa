<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_teachers', function (Blueprint $table): void {
            $table->id();
            $table->integer('classroom_id');
            $table->uuid('user_id');
            $table->integer('subject_id');
            $table->string('comment')->nullable();
            $table->timestamps();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->unique(['user_id', 'classroom_id', 'subject_id']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // TODO une constraint avec users pour le role TEACHER
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment_teachers');
    }
};
