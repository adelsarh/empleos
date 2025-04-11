<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Verificar si el administrador ya existe
        if (!DB::table('users')->where('email', 'administrador@empleos.adelsar.hn')->exists()) {
            DB::table('users')->insert([
                'name' => 'Administrador del Sistema',
                'email' => 'administrador@empleos.adelsar.hn',
                'email_verified_at' => now(),
                'password' => Hash::make('AdminVacantes123!'), // Contraseña segura por defecto
                'remember_token' => Str::random(10),
                'rol_id' => 3,
                'estado' => 1,
                'creditos' => 999,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->command->info('Usuario administrador creado exitosamente!');
            $this->command->warn('Credenciales por defecto:');
            $this->command->line('Email: admin@vacantes.hn');
            $this->command->line('Password: AdminVacantes123!');
        } else {
            $this->command->info('El usuario administrador ya existe en la base de datos.');
        }
    }
}
