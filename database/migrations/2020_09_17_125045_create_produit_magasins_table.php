<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitMagasinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_magasins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('id_produit');
            $table->unsignedBigInteger('id_magasin');
            $table->foreign('id_produit')
                ->references('id')
                ->on('produits')
                ->onDelete('cascade');
            $table->foreign('id_magasin')
                ->references('id')
                ->on('magasins')
                ->onDelete('cascade');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produit_magasins');
    }
}
