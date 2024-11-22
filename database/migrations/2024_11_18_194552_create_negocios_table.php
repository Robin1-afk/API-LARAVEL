<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocios', function (Blueprint $table) {
            $table->id(); // Genera un campo id
            $table->string('nombre_negocio'); // Nombre del negocio
            $table->string('subscription_type'); // Tipo de suscripción
            $table->date('fecha_suscripcion'); // Fecha de suscripción
            $table->date('fecha_ultimo_pago'); // Fecha del último pago
            $table->date('fecha_fin_suscripcion'); // Fecha de fin de suscripción
            $table->timestamps(); // Para las fechas de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('negocios');
    }
}
