<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table): void {
            $table->id();
            $table->integer('period_id');
            $table->string('name');
            $table->string('comment')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->unique(['period_id', 'name']);

            $table->foreign('period_id')->references('id')->on('periods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classrooms');
    }
}
