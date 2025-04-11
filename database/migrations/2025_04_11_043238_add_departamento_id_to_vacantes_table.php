<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */public function up()
    {
        Schema::table('vacantes', function (Blueprint $table) {
            $table->foreignId('departamento_id')
                ->constrained()
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('vacantes', function (Blueprint $table) {
            $table->dropForeign(['departamento_id']);
            $table->dropColumn('departamento_id');
        });
    }

};
