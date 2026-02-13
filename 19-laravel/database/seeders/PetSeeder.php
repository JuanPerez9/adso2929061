<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pet = new Pet;
        $pet->name = 'Simeon';
        $pet->kind = 'cat';
        $pet->weight = 4.5;
        $pet->age = 6;
        $pet->breed = 'Siamés';
        $pet->location = 'Arabia';
        $pet->description = 'Blurred cat, too intelligent';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Charle';
        $pet->kind = 'dog';
        $pet->weight = 7.8;
        $pet->age = 7;
        $pet->breed = 'German Shepherd';
        $pet->location = 'Germany';
        $pet->description = 'Super protective and affectionate dog';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Pisco';
        $pet->kind = 'Bird';
        $pet->weight = 2;
        $pet->age = 2;
        $pet->breed = 'Canary';
        $pet->location = 'Canary Islands';
        $pet->description = 'They have a lot of vitality and energy';
        $pet->save();
    }
}
