<?php

use App\Models\Appreciation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppreciationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appreciations', function (Blueprint $table): void {
            $table->id();
            $table->string('short_name', 10);
            $table->json('name');
            $table->tinyInteger('position');
            $table->string('status')->default('ACTIVE')->comment('ACTIVE / INACTIVE');
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
        });

        $appreciations = [
            [
                'short_name' => 'EX',
                'name' => ['en' => 'Excellent', 'fr' => 'Excellent'],
                'position' => 10,
            ],
            [
                'short_name' => 'TB',
                'name' => ['en' => 'Very Good', 'fr' => 'Très bien'],
                'position' => 20,
            ],
            [
                'short_name' => 'B',
                'name' => ['en' => 'Good', 'fr' => 'Bien'],
                'position' => 30,
            ],
            [
                'short_name' => 'MOY',
                'name' => ['en' => 'Average', 'fr' => 'Moyen'],
                'position' => 40,
            ],
            [
                'short_name' => 'INS',
                'name' => ['en' => 'Insufficient', 'fr' => 'Insuffisant'],
                'position' => 50,
            ],
        ];

        foreach ($appreciations as $appreciation) {
            Appreciation::create($appreciation);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appreciations');
    }
}
