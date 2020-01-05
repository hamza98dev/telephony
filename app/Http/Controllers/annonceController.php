<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use DB;
use File;
use App\favori;
use App\annonce;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\postrequest;
class annonceController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            return view('duan');
        } else {
            return view('auth.login');
        }
        
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
            return view('showannonce');
        
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    

        $ann=new annonce();
        $ann->description_article=$request->input('descp');
        $ann->nom_article=strtolower($request->input('nomp'));
        $ann->prix_article=$request->input('prixp');
        $ann->user_id=$request->input('idUser');
        $ann->ville_article=$request->input('villep');
        $ann->marque=$request->input('mf');
        if($request->get('photop1'))
        {
            $ann->photo_article = $request->get('photop1');
           $name = time().'.' . explode('/', explode(':', substr($ann->photo_article, 0, strpos($ann->photo_article, ';')))[1])[1];
           \Image::make($request->get('photop1'))->save(public_path('image').$name);
         }
         
         


         if($request->get('photop2'))
         {
             $ann->photo_article1 = $request->get('photop2');
            $name11 = time().'..' . explode('/', explode(':', substr($ann->photo_article1, 0, strpos($ann->photo_article1, ';')))[1])[1];
            \Image::make($request->get('photop2'))->save(public_path('image').$name11);
          }
          if($request->get('photop3'))
          {
              $ann->photo_article2 = $request->get('photop3');
             $name22 = time().'..' . explode('//', explode(':', substr($ann->photo_article2, 0, strpos($ann->photo_article2, ';')))[1])[1];
             \Image::make($request->get('photop3'))->save(public_path('image').$name22);
           } 
        //    $ann->photo_article2 = "image".$name22;
          $ann->photo_article = "image".$name;
          $ann->photo_article1 = "image".$name11;


    

         
        $ann->save();
        session()->flash('succes','ajoutez avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dt=DB::select('select * from annonces where user_id=?',[$id]);
        return $dt;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('delete from annonces where id=?',[$id]);
    }
    public function showphones(){
        $phones=DB::select('select * from annonces where status=?',["active"]);
        return $phones;
    }
    public function phonedetail($id){
        $thisphone=DB::select('select * from annonces where id =?',[$id]);
        $u=DB::select('select user_id from annonces where id=? ',[$id]);
        $user=DB::select('select * from users where id=?',[$u[0]->user_id]);
        $data = ["thisphone"=> $thisphone,"user" =>$user ];
        return $data;
    }

    public function graph(){
        $y=0;
         $today =DB::select('Select DAYOFWEEK(NOW()) as today');
        
        for($x =  $today[0]->today; $x > 1 ; $x--,  $y++){           
        }
        for ($i=$today[0]->today , $j=$y , $u=0 ; $i>=1  ; $j--,$i--,$u++) { 
           $dt[$u]=DB::select('select count(*) as counter from annonces where created_at=CURRENT_DATE() - INTERVAL '.$j.' DAY');
        }
        return response()->json($dt,200);
     
    }
    public function upstats($id){
            DB::update('update annonces set status="vendu" where id = ?',[$id]);
            $status =DB::select('select status from annonces where id =?',[$id]);
            return $status;
    }
  
}
