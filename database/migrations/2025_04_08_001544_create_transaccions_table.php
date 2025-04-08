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
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('planes')->onDelete('cascade');
            $table->decimal('monto', 10, 2);
            $table->string('referencia')->nullable();
            $table->string('comprobante');
            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado', 'reembolsado'])->default('pendiente');
            $table->timestamp('fecha_aprobacion')->nullable();
            $table->foreignId('aprobado_por')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('creditos')->default(0);
            $table->timestamp('ultimo_pago_valido')->nullable(); // Fecha último pago aprobado
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaccions');
    }
};
