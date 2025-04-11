<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SalarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $salarios = [
            // Nivel básico/operativo
            ['salario' => 'Menos de 5,000 L mensuales', 'created_at' => $now, 'updated_at' => $now],
            ['salario' => '5,000 L - 7,999 L mensuales', 'created_at' => $now, 'updated_at' => $now],
            ['salario' => '8,000 L - 10,999 L mensuales', 'created_at' => $now, 'updated_at' => $now],

            // Nivel técnico/especializado
            ['salario' => '11,000 L - 14,999 L mensuales', 'created_at' => $now, 'updated_at' => $now],
            ['salario' => '15,000 L - 19,999 L mensuales', 'created_at' => $now, 'updated_at' => $now],

            // Nivel profesional
            ['salario' => '20,000 L - 29,999 L mensuales', 'created_at' => $now, 'updated_at' => $now],

            // Opciones especiales
            ['salario' => 'Salario a convenir', 'created_at' => $now, 'updated_at' => $now],
            ['salario' => 'Por hora/proyecto', 'created_at' => $now, 'updated_at' => $now]
        ];

        DB::table('salarios')->insert($salarios);
    }
}
