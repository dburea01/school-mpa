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
            $table->json('name');
            $table->tinyInteger('position');
            $table->boolean('displayable')->default(false);
            $table->boolean('family_role');
            $table->timestamps();
        });

        $role = new Role();
        $role->id = 'TEACHER';
        $role->position = 10;
        $role->displayable = true;
        $role->family_role = false;
        $role->name = ['en' => 'Teacher', 'fr' => 'Enseignant'];
        $role->save();

        $role = new Role();
        $role->id = 'STUDENT';
        $role->position = 20;
        $role->displayable = true;
        $role->family_role = true;
        $role->name = ['en' => 'Student', 'fr' => 'Etudiant'];
        $role->save();

        $role = new Role();
        $role->id = 'PARENT';
        $role->position = 30;
        $role->displayable = true;
        $role->family_role = true;
        $role->name = ['en' => 'Parent', 'fr' => 'Parent'];
        $role->save();

        $role = new Role();
        $role->id = 'DIRECTOR';
        $role->position = 40;
        $role->displayable = true;
        $role->family_role = false;
        $role->name = ['en' => 'Director', 'fr' => 'Directeur'];
        $role->save();

        $role = new Role();
        $role->id = 'SUPERADMIN';
        $role->position = 50;
        $role->displayable = false;
        $role->family_role = false;
        $role->name = ['en' => 'Super Administrator', 'fr' => 'Super Administrateur'];
        $role->save();
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
