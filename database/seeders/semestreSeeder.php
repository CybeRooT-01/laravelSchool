<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class semestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semestre = [
            [
                'libelle'=>'trimestre 1',
                'classe_id'=>1
            ],
            [
                'libelle'=>'trimestre 2',
                'classe_id'=>1
            ],
            [
                'libelle'=>'trimestre 3',
                'classe_id'=>1
            ],
            [
                'libelle'=>'semestre 1',
                'classe_id'=>7
            ],
            [
                'libelle'=>'semestre 2',
                'classe_id'=>8
            ],
        ];
        \App\Models\Semestre::insert($semestre);
    }
}
