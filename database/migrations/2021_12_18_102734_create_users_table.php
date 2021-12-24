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
            $table->uuid('school_id')->nullable();
            $table->string('status');
            $table->string('role_id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        

            $table->foreign('school_id')->references('id')->on('schools')->cascadeOnDelete();
            $table->foreign('role_id')->references('id')->on('roles')->nullOnDelete();
        });

        DB::statement('ALTER TABLE users ADD CONSTRAINT check_is_super_admin CHECK ( (school_id IS NULL AND role_id = \'SUPERADMIN\') OR (school_id IS NOT NULL) )');
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
