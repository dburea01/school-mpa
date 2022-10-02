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
        Schema::create('results', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('school_id');
            $table->uuid('exam_id');
            $table->uuid('user_id');
            $table->decimal('note_num', 8, 2)->nullable();
            $table->string('note_alpha')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->string('created_by');
            $table->string('updated_by')->nullable();

            $table->foreign('school_id')->references('id')->on('schools')->nullOnDelete();
            $table->foreign('exam_id')->references('id')->on('exams')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();

            $table->unique(['school_id', 'exam_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
};
