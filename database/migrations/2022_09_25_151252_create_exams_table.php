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
        Schema::create('exams', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('exam_type_id');
            $table->uuid('subject_id');
            $table->uuid('classroom_id');
            $table->integer('exam_status_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->time('duration')->nullable();
            $table->text('instructions')->nullable();
            $table->timestamps();
            $table->string('created_by');
            $table->string('updated_by')->nullable();

            $table->foreign('exam_type_id')->references('id')->on('exam_types')->nullOnDelete();
            $table->foreign('subject_id')->references('id')->on('subjects')->nullOnDelete();
            $table->foreign('classroom_id')->references('id')->on('classrooms')->cascadeOnDelete();
            $table->foreign('exam_status_id')->references('id')->on('exam_status')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
};
