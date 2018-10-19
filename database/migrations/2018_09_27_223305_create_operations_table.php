<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_operation');
            $table->date('date_valeur');
            $table->double('montant_net', 15, 8);
            $table->double('vl_mad', 15, 8);
            $table->string('opcvm');
            $table->string('nombre_part');
            $table->string('statut');
            $table->integer('conpte_id')->unsigned();


            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operations');
    }
}
