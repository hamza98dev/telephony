<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\annonce;
use App\user;
class CreateFavorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoris', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
             ->references('id')->on('users')
            ->onDelete('cascade');

            $table->unsignedBigInteger('annonce_id');
            $table->foreign('annonce_id')
             ->references('id')->on('annonces')
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
        Schema::dropIfExists('favoris');
    }
    public function user(){
        $this->hasMany('App\user');
    }
    public function annonce(){
        $this->hasMany('App\annonce');
    }

}
