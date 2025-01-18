<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vacantes', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropForeign(['salario_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'titulo',
                'salario_id',
                'categoria_id',
                'empresa',
                'utimo_dia',
                'descripcion',
                'imagen',
                'publicado',
                'user_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
