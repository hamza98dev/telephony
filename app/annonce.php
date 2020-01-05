<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class annonce extends Model
{
    protected $table="annonces";

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
