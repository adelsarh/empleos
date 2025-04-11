<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    public function run()
    {
        $departamentos = [
            ['nombre' => 'Atlántida', 'codigo' => 'atlantida', 'region' => 'Norte'],
            ['nombre' => 'Choluteca', 'codigo' => 'choluteca', 'region' => 'Sur'],
            ['nombre' => 'Colón', 'codigo' => 'colon', 'region' => 'Norte'],
            ['nombre' => 'Comayagua', 'codigo' => 'comayagua', 'region' => 'Central'],
            ['nombre' => 'Copán', 'codigo' => 'copan', 'region' => 'Occidental'],
            ['nombre' => 'Cortés', 'codigo' => 'cortes', 'region' => 'Norte'],
            ['nombre' => 'El Paraíso', 'codigo' => 'el_paraiso', 'region' => 'Oriental'],
            ['nombre' => 'Francisco Morazán', 'codigo' => 'francisco_morazan', 'region' => 'Central'],
            ['nombre' => 'Gracias a Dios', 'codigo' => 'gracias_a_dios', 'region' => 'Oriental'],
            ['nombre' => 'Intibucá', 'codigo' => 'intibuca', 'region' => 'Occidental'],
            ['nombre' => 'Islas de la Bahía', 'codigo' => 'islas_de_la_bahia', 'region' => 'Norte'],
            ['nombre' => 'La Paz', 'codigo' => 'la_paz', 'region' => 'Central'],
            ['nombre' => 'Lempira', 'codigo' => 'lempira', 'region' => 'Occidental'],
            ['nombre' => 'Ocotepeque', 'codigo' => 'ocotepeque', 'region' => 'Occidental'],
            ['nombre' => 'Olancho', 'codigo' => 'olancho', 'region' => 'Oriental'],
            ['nombre' => 'Santa Bárbara', 'codigo' => 'santa_barbara', 'region' => 'Occidental'],
            ['nombre' => 'Valle', 'codigo' => 'valle', 'region' => 'Sur'],
            ['nombre' => 'Yoro', 'codigo' => 'yoro', 'region' => 'Norte']
        ];

        DB::table('departamentos')->insert($departamentos);
    }
}
