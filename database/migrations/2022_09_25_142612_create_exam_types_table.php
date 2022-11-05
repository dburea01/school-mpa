<?php

use App\Models\ExamType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_types', function (Blueprint $table) {
            $table->id();
            $table->json('short_name');
            $table->json('name');
            $table->tinyInteger('position');
            $table->string('status')->comment('ACTIVE / INACTIVE')->default('ACTIVE');
            $table->timestamps();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
        });

        $examTypes = [
            [

                'position' => 10,
                'short_name' => ['en' => 'USW', 'fr' => 'DNS'],
                'name' => ['en' => 'Unsupervised work', 'fr' => 'Devoir non surveillé'],

            ],
            [

                'position' => 20,
                'short_name' => ['en' => 'SD', 'fr' => 'DS'],
                'name' => ['en' => 'Supervised work', 'fr' => 'Devoir surveillé'],

            ],
            [

                'position' => 30,
                'short_name' => ['en' => 'OW', 'fr' => 'OR'],
                'name' => ['en' => 'Oral Work', 'fr' => 'Oral'],

            ],
        ];

        foreach ($examTypes as $examType) {
            ExamType::create($examType);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_types');
    }
}
