<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Liste des classes avec le bon nom de colonne "tuition_fee"
        $classrooms = [
            ['name' => 'CP1', 'tuition_fee' => 35000],
            ['name' => 'CP2', 'tuition_fee' => 35000],
            ['name' => 'CE1', 'tuition_fee' => 40000],
            ['name' => 'CE2', 'tuition_fee' => 40000],
            ['name' => 'CM1', 'tuition_fee' => 50000],
            ['name' => 'CM2', 'tuition_fee' => 50000],
        ];

        // Insertion exacte en base de données
        foreach ($classrooms as $classroom) {
            Classroom::create([
                'name' => $classroom['name'],
                'tuition_fee' => $classroom['tuition_fee'],
            ]);
        }
    }
}
