<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class updateController extends Controller
{
    public function update(Request $req,$id){
        $nom=$req->input('nom');
        $email=$req->input('email');
        $tele=$req->input('tele');
       $pass=Hash::make($req->input('pass'));

        DB::update('update users set name=? , email=?,telephone =? ,password =? where id=? ',[ $nom,$email,$tele,$pass,$id]);


    }
}
