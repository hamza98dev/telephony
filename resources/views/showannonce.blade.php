@extends('layouts.master')
<style>
  *{
    font-family: 'Montserrat', sans-serif;

  }
  .card-1 {
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}
.card-1:hover {
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}

body{
background-color: lightgoldenrodyellow;

}
.lk:hover{
  border: 1px solid lightgray;
  background-color: lightgray;
  color: white;
  transition: 0,5ms cubic-bezier();
}

</style>
@section('content')
<div id="app">

  <div style="margin-top: 100px " class="container">

    <div class="input-group mb-3">
      <div class="input-group-prepend">
        
        </span>
      </div>
      <div class="container">
          <div class="row ">
              <div class="col-md-4  my-1">
                  <span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i>
                  <input type="text" v-model="search" class="form-control w-100 mx-1" placeholder="chercher par nom" aria-label="Username" aria-describedby="basic-addon1"> 
              </div>
              <div class="col-md-4 my-1">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-street-view"></i>
                  <input type="text" v-model="ville" class="form-control w-100 mx-1" placeholder="chercher par Ville" aria-label="Username" aria-describedby="basic-addon1"> 
              </div>
              <div class="col-md-4  my-1">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-mobile"></i></i>
                  <select class="form-control mx-3" v-model="mf">
                    <option value="" selected>Toutes Les Marques</option>
                    <option>Iphone</option>
                    <option>samsung</option>
                    <option>huawei</option>
                    <option>lg</option>
                    <option>infinix</option>
                    <option>oppo</option>
                    <option>sony</option>
                    <option>wiko</option>


                </select>
                </div>
            </div>
      </div>
      
      
    </div>
    <h3 v-if="affno">Pas d'annonces Pour le Moment</h3>
<div class="container">
    <div class="row justify-content-center" >

      <div class="col-md-4 col-sm-12 my-2 animated fadeIn slow" v-for="it in filtrephone">
  <div class="card card-1" style="width: 19rem;border:none;height:12cm">
    <img :src="it.photo_article" style="max-height:250px;max-width:100%"  class="card-img-top justify-content-center embed-responsive-item" alt="...">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">@{{it.nom_article}}</h5 >
        <p class="card-text"><i class="fa fa-map-marker" aria-hidden="true"></i> @{{it.ville_article}}</p>
      <h4 class="text-center mt-auto" style="color:purple;font-weight: 550">@{{it.prix_article  }} DH</h4>
      <a style="border: 1px solid lightgray;" href="#" data-toggle="modal" data-target="#exampleModal" @click="getinfo(it.id)" class="btn lk mt-auto"><i class="far fa-eye"></i> Voir</a>
            

    </div>
  </div>
</div>

    </div>
  </div>
  </div>
  <div class="modal animated fadeIn slow" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" v-for="item in detail">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">@{{item.nom_article}}</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
           
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img :src="item.photo_article" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img :src="item.photo_article1" class="d-block w-100" alt="...">
                </div>
               
              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div><br>
        <label for="" style="font-weight: bold"> Description:</label>
      <p>@{{item.description_article}}</p>
      <label for="" style="font-weight: bold"> Marque:</label>
      <p style="font-weight:bold">@{{item.marque}}</p>
      <label for="" style="font-weight: bold"> Prix:</label>
      <p>@{{item.prix_article}}</p>
      <hr>
      <div class="card text-white bg-primary mb-3 justify-content-center" style="max-width: 30rem;" v-for="us in utilisateur">
      <div class="card-header" style="text-align: center">@{{us.name}}</div>
        <div class="card-body">
        <h3 class="card-title"><i class="fa fa-phone" aria-hidden="true"></i> @{{us.telephone}}</h3>
        <p class="card-text"><i class="fa fa-map-marker" aria-hidden="true"></i> @{{item.ville_article}}</p>

        <p class="card-text"> <i class="fa fa-envelope" aria-hidden="true"></i> @{{us.email}}</p>
        

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
</div>
<script>

  window.laravel = {!! json_encode([
      'csrfToken' => csrf_token(),
      'url' => url('/'),  
  ]) !!};
</script>


  <script>
  new Vue({
      el:'#app',
      data:{
        phones:[],
        detail:[],
        utilisateur:[],
        status:false,
        search:'',
        mf:'',
        favstats:false,
        affno:false,
        ville:'',
      },
      methods:{
        getphones(){
          axios.get('/api/gd')
          .then(res=>{
               this.phones=res.data;
               console.log(this.phones);
                if (this.phones.length == 0) {
                  this.affno=!this.affno;
                }
          })
        },
        getinfo(id){
          console.log(id);

          axios.get('/api/mdl/'+id)
          .then(res =>{

            this.utilisateur=res.data.user;
            this.detail=res.data.thisphone;
            console.log(this.detail);
            console.log(this.utilisateur);





          })

        },
  
      },
      mounted(){
        this.getphones();
      },
      computed:{
          filtrephone(){
            return this.phones.filter(phone =>{
              return phone.nom_article.match(this.search.toLowerCase()) && phone.ville_article.match(this.ville) && phone.marque.match(this.mf);
            })
          },
          
      }

  })
  </script>


@endsection

