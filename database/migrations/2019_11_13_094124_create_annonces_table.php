<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;
class CreateAnnoncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_article');
            $table->string('description_article');
            $table->integer('prix_article');
            $table->string('ville_article');
            $table->string('status')->default('active');
            $table->string('photo_article');
            $table->string('marque');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
             ->references('id')->on('users')
            ->onDelete('cascade');
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
        Schema::dropIfExists('annonces');
    }
    public function user(){
        $this->belongsTo('App\user');
    }
}
