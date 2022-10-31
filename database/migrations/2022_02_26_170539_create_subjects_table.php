<?php

use App\Models\Subject;
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
            $table->id();
            $table->string('short_name', 10);
            $table->json('name');
            $table->integer('position');
            $table->string('status')->default('ACTIVE')->comment('ACTIVE / INACTIVE');
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
        });

        $subjects = [
            [
                'short_name' => 'FRA',
                'name' => ['en' => 'French', 'fr' => 'Français'],
                'position' => 10,
            ],
            [
                'short_name' => 'ENG',
                'name' => ['en' => 'English', 'fr' => 'Anglais'],
                'position' => 20,
            ],
            [
                'short_name' => 'LAT',
                'name' => ['en' => 'Latin', 'fr' => 'Latin'],
                'position' => 30,
            ],
            [
                'short_name' => 'MATH',
                'name' => ['en' => 'Mathematiques', 'fr' => 'Mathématiques'],
                'position' => 40,
            ],
            [
                'short_name' => 'HIS/GEO',
                'name' => ['en' => 'History and Geography', 'fr' => 'Histoire et Géographie'],
                'position' => 50,
            ],
            [
                'short_name' => 'CIV',
                'name' => ['en' => 'Civil Education', 'fr' => 'Education civique'],
                'position' => 60,
            ],
            [
                'short_name' => 'SVT',
                'name' => ['en' => 'Science of life and earth', 'fr' => 'Science de la vie et de la Terre'],
                'position' => 70,
            ],
            [
                'short_name' => 'PHY/CHI',
                'name' => ['en' => 'Physic and Chemistry', 'fr' => 'Physique-Chimie'],
                'position' => 80,
            ],
            [
                'short_name' => 'TEC',
                'name' => ['en' => 'Technology', 'fr' => 'Technologie'],
                'position' => 90,
            ],
            [
                'short_name' => 'EPS',
                'name' => ['en' => 'physical education and sport', 'fr' => 'Education physique et sportive'],
                'position' => 100,
            ],
            [
                'short_name' => 'ART',
                'name' => ['en' => 'Plastical arts', 'fr' => 'Arts plastiques'],
                'position' => 110,
            ],
            [
                'short_name' => 'MUS',
                'name' => ['en' => 'Musical education', 'fr' => 'Education musicale'],
                'position' => 120,
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
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
