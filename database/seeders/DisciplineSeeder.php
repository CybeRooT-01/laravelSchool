<?php

namespace Database\Seeders;

use App\Models\Discipline;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discipline = [
           [
            "libelle" => "Mathématiques"
           ],
           [
            "libelle" => "Français"
           ],
           [
            "libelle" => "Anglais"
           ]
        ];
        Discipline::insert($discipline);

        
    }
}
