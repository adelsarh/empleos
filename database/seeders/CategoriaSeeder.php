<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $categorias = [
            ['categoria' => 'Administración', 'created_at' => $now, 'updated_at' => $now],
            ['categoria' => 'Operaciones', 'created_at' => $now, 'updated_at' => $now],
            ['categoria' => 'Logística', 'created_at' => $now, 'updated_at' => $now],
            ['categoria' => 'Finanzas y Contabilidad', 'created_at' => $now, 'updated_at' => $now],
            ['categoria' => 'Recursos Humanos', 'created_at' => $now, 'updated_at' => $now],
            ['categoria' => 'Tecnología de Información', 'created_at' => $now, 'updated_at' => $now],
            ['categoria' => 'Desarrollo de Software', 'created_at' => $now, 'updated_at' => $now],
            ['categoria' => 'Marketing y Ventas', 'created_at' => $now, 'updated_at' => $now],
            ['categoria' => 'Servicio al Cliente', 'created_at' => $now, 'updated_at' => $now],
            ['categoria' => 'Ingeniería', 'created_at' => $now, 'updated_at' => $now],
            ['categoria' => 'Construcción', 'created_at' => $now, 'updated_at' => $now],
            ['categoria' => 'Salud y Medicina', 'created_at' => $now, 'updated_at' => $now],
            ['categoria' => 'Educación', 'created_at' => $now, 'updated_at' => $now],
            ['categoria' => 'Agroindustria', 'created_at' => $now, 'updated_at' => $now],
            ['categoria' => 'Turismo y Hotelería', 'created_at' => $now, 'updated_at' => $now],
            ['categoria' => 'Varios', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('categorias')->insert($categorias);
    }
}
