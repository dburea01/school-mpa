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
            $table->timestamps();
        });

        $roles = [
            [
                'id' => 'TEACHER',
                'position' => 10,
                'name' => ['en' => 'Teacher', 'fr' => 'Enseignant'],
                'displayable' => true,
            ],
            [
                'id' => 'STUDENT',
                'position' => 20,
                'name' => ['en' => 'Student', 'fr' => 'Etudiant'],
                'displayable' => true,
            ],
            [
                'id' => 'PARENT',
                'position' => 30,
                'name' => ['en' => 'Parent', 'fr' => 'Parent'],
                'displayable' => true,
            ],
            [
                'id' => 'DIRECTOR',
                'position' => 40,
                'name' => ['en' => 'Director', 'fr' => 'Directeur'],
                'displayable' => true,
            ],
            [
                'id' => 'ADMIN',
                'position' => 50,
                'name' => ['en' => 'Administrator', 'fr' => 'Administrateur'],
                'displayable' => false,
            ],

        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
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
