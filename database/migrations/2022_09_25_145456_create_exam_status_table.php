<?php

use App\Models\ExamStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_status', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->tinyInteger('position');
            $table->json('short_name');
            $table->json('comment');
            $table->timestamps();
        });

        $examStatus = [
            [
                'id' => '10',
                'position' => '10',
                'short_name' => [
                    'en' => 'DRAFT',
                    'fr' => 'BROUILLON',
                ],
                'comment' => [
                    'en' => 'The exam is not yet defined, not visible. It\'s only a draft for the moment',
                    'fr' => 'L\'examen n\'est pas encore définie. Non visible. C\'est juste un brouillon pour le moment',
                ],
            ],
            [
                'id' => '20',
                'position' => '20',
                'short_name' => [
                    'en' => 'PLANNED',
                    'fr' => 'PLANIFIE',
                ],
                'comment' => [
                    'en' => 'The exam is planned.',
                    'fr' => 'L\'examen est planifié.',
                ],
            ],
            [
                'id' => '30',
                'position' => '30',
                'short_name' => [
                    'en' => 'INPROGRESS',
                    'fr' => 'ENCOURS',
                ],
                'comment' => [
                    'en' => 'The exam is in progress.',
                    'fr' => 'L\'examen est en cours.',
                ],
            ],
            [
                'id' => '40',
                'position' => '40',
                'short_name' => [
                    'en' => 'TERMINATED',
                    'fr' => 'TERMINE',
                ],
                'comment' => [
                    'en' => 'The exam is terminated, to be corrected',
                    'fr' => 'L\'examen est terminé. Doit être corrigé.',
                ],
            ],
            [
                'id' => '50',
                'position' => '50',
                'short_name' => [
                    'en' => 'CORRECTED',
                    'fr' => 'CORRIGE',
                ],
                'comment' => [
                    'en' => 'The exam is corrected, all the students have a note.',
                    'fr' => 'L\'examen est corrigé, tous les étudiants ont une note.',
                ],
            ],
        ];

        foreach ($examStatus as $examStatu) {
            ExamStatus::create($examStatu);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_status');
    }
}
