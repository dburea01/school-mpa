<?php

use App\Models\Civility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('civilities', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->json('short_name');
            $table->json('name');
            $table->boolean('is_active')->default('true');
            $table->tinyInteger('position');
            $table->timestamps();
        });

        $civilities = [
            [
                'id' => 'MR',
                'short_name' => [
                    'en' => 'Mr',
                    'fr' => 'Monsieur',
                ],
                'name' => [
                    'en' => 'Mister',
                    'fr' => 'Monsieur',
                ],
                'position' => 10,
            ],
            [
                'id' => 'MISS',
                'short_name' => [
                    'en' => 'Ms',
                    'fr' => 'Mde',
                ],
                'name' => [
                    'en' => 'Miss',
                    'fr' => 'Madame',
                ],
                'position' => 20,
            ]
        ];

        foreach ($civilities as $civility) {
            Civility::create($civility);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('civilities');
    }
};
