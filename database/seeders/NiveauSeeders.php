<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NiveauSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $niveaux = [
            [
                'nom' => 'Primaire'
            ],
            [
                'nom' => 'Secondaire Inferieur'
            ],
            [
                'nom' => 'Secondaire superieur'
            ],
        ];
        \App\Models\Niveau::insert($niveaux);
    }
}
