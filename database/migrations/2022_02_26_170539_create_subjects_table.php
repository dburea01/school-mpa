<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->uuid('school_id');
            $table->string('short_name', 10);
            $table->string('name');
            $table->boolean('option');
            $table->string('status');
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->unique(['school_id', 'short_name']);
        });

        Schema::table('subjects', function (Blueprint $table): void {
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
