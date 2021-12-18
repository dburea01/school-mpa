<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->tinyInteger('position');
            $table->boolean('displayable')->default(false);
            $table->timestamps();
        });

        Role::insert(['id' => 'TEACHER', 'name' => 'Teacher', 'position' => 10, 'displayable' => true]);
        Role::insert(['id' => 'STUDENT', 'name' => 'Student', 'position' => 20, 'displayable' => true]);
        Role::insert(['id' => 'PARENT', 'name' => 'Parent', 'position' => 30, 'displayable' => true]);
        Role::insert(['id' => 'DIRECTOR', 'name' => 'Director', 'position' => 40, 'displayable' => true]);
        Role::insert(['id' => 'SUPERADMIN', 'name' => 'Super Administrator', 'position' => 50, 'displayable' => false]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
