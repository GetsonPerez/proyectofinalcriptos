<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criptomoneda_transacciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criptomoneda_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->enum('tipo', ['compra', 'venta']);
            $table->decimal('cantidad', 16, 6);
            $table->decimal('precio_usd', 16, 6);
            $table->decimal('precio_quetzal', 16, 6);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criptomoneda_transacciones');
    }
};
