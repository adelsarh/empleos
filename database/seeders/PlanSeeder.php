<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = now();

        DB::table('planes')->insert([
            [
                'nombre' => 'Plan Básico',
                'precio' => 800.00, // Lempiras
                'creditos' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'nombre' => 'Plan Estándar',
                'precio' => 1500.00,
                'creditos' => 7,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'nombre' => 'Plan Premium',
                'precio' => 2500.00,
                'creditos' => 15,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
