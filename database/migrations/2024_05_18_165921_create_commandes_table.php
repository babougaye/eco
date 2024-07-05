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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('prenom')->nullable();
            $table->string('nom')->nullable();
            $table->string('email')->nullable();
            $table->string('addresse')->nullable();
            $table->string('telephone')->nullable();
            $table->string('titre_produit')->nullable();
            $table->string('user-id')->nullable();
            $table->string('prix')->nullable();
            $table->string('quantite')->nullable();
            $table->string('image')->nullable();
            $table->string('produit_id')->nullable();
            $table->string('status_paiement')->nullable();
            $table->string('status_delivere')->nullable();
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
        Schema::dropIfExists('commandes');
    }
};
