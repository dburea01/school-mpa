<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('role_id');
            $table->string('status')->default('ACTIVE')->comment('ACTIVE / INACTIVE');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('gender_id', 1)->nullable()->comment('1 : male / 2 : female');
            $table->string('civility_id', 10)->nullable()->comment('Mr / Miss');
            $table->string('email')->nullable();
            $table->date('birth_date')->nullable();
            $table->text('comment')->nullable();
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->text('address3')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('city')->nullable();
            $table->string('country_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('user_image_url')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->nullOnDelete();
            $table->foreign('civility_id')->references('id')->on('civilities')->nullOnDelete();
            $table->foreign('country_id')->references('id')->on('countries')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
