<?php
namespace App\Repositories;

use App\Models\Appreciation;

class AppreciationRepository
{
    public function all()
    {
        return Appreciation::orderBy('position')->get();
    }

    public function update(Appreciation $appreciation, array $data): Appreciation
    {
        $appreciation->fill($data);

        $appreciation->name = [
            'fr' => $data['name_fr'],
            'en' => $data['name_en']
        ];
        $appreciation->save();

        return $appreciation;
    }

    public function destroy(Appreciation $appreciation): void
    {
        $appreciation->delete();
    }

    public function insert(array $data): Appreciation
    {
        $appreciation = new Appreciation();
        $appreciation->fill($data);
        $appreciation->name = [
            'fr' => $data['name_fr'],
            'en' => $data['name_en']
        ];
        $appreciation->position = 1;
        $appreciation->save();

        return $appreciation;
    }
}
