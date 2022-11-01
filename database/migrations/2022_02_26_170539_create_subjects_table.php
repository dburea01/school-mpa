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
            ],
            [
                'short_name' => 'ENG',
                'name' => ['en' => 'English', 'fr' => 'Anglais'],
            ],
            [
                'short_name' => 'LAT',
                'name' => ['en' => 'Latin', 'fr' => 'Latin'],
            ],
            [
                'short_name' => 'MATH',
                'name' => ['en' => 'Mathematiques', 'fr' => 'Mathématiques'],
            ],
            [
                'short_name' => 'HIS/GEO',
                'name' => ['en' => 'History and Geography', 'fr' => 'Histoire et Géographie'],
            ],
            [
                'short_name' => 'CIV',
                'name' => ['en' => 'Civil Education', 'fr' => 'Education civique'],
            ],
            [
                'short_name' => 'SVT',
                'name' => ['en' => 'Science of life and earth', 'fr' => 'Science de la vie et de la Terre'],
            ],
            [
                'short_name' => 'PHY/CHI',
                'name' => ['en' => 'Physic and Chemistry', 'fr' => 'Physique-Chimie'],
            ],
            [
                'short_name' => 'TEC',
                'name' => ['en' => 'Technology', 'fr' => 'Technologie'],
            ],
            [
                'short_name' => 'EPS',
                'name' => ['en' => 'physical education and sport', 'fr' => 'Education physique et sportive'],
            ],
            [
                'short_name' => 'ART',
                'name' => ['en' => 'Plastical arts', 'fr' => 'Arts plastiques'],
            ],
            [
                'short_name' => 'MUS',
                'name' => ['en' => 'Musical education', 'fr' => 'Education musicale'],
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
