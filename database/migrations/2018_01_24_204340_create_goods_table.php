<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->text('photo');
            $table->string('titre');
            $table->text('description');
            $table->float('prix_depart');
            $table->float('prix_final');
            $table->timestamp('date_debut')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('date_fin')->nullable();
            $table->unsignedInteger('acheteur_id');
            $table->unsignedInteger('vendeur_id');

            $table->foreign('acheteur_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('vendeur_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('goods');
    }
}
