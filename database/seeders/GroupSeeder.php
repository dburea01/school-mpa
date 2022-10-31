<?php
namespace Database\Seeders;

use App\Models\Group;
use App\Models\School;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::factory()->count(random_int(5, 20))->create();
    }
}
