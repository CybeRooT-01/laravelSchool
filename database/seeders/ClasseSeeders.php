<?php

namespace Database\Seeders;

use App\Models\Niveau;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $primaire =Niveau::where('nom', 'Primaire')->first();
        $secondaire = Niveau::where('nom', 'Secondaire Inferieur')->first();
        $lycee = Niveau::where('nom', 'Secondaire superieur')->first();
        $classes = [
            [
                'nom'=>'CI',
                'niveau_id' => $primaire->id
            ],
            [
                'nom'=>'CP',
                'niveau_id' => $primaire->id
            ],
            [
                'nom'=>'CE1',
                'niveau_id' => $primaire->id
            ],
            [
                'nom'=>'CE2',
                'niveau_id' => $primaire->id
            ],
            [
                'nom'=>'CM1',
                'niveau_id' => $primaire->id
            ],
            [
                'nom'=>'CM2',
                'niveau_id' => $primaire->id
            ],
            [
                'nom'=>'6e',
                'niveau_id' => $secondaire->id
            ],
            [
                'nom'=>'5e',
                'niveau_id' => $secondaire->id
            ],
            [
                'nom'=>'4e',
                'niveau_id' => $secondaire->id
            ],
            [
                'nom'=>'3e',
                'niveau_id' => $secondaire->id
            ],
            [
                'nom'=>'2nde',
                'niveau_id' => $lycee->id
            ],
            [
                'nom'=>'1ere',
                'niveau_id' => $lycee->id
            ],
            [
                'nom'=>'Tle',
                'niveau_id' => $lycee->id
            ],
        ];
        \App\Models\Classe::insert($classes);
    }
}
