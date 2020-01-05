@extends('layouts.master')
<style>
.compte{
    width: 320px;
    height: 90px;
    margin: 0 auto;
    background-color: lightslategray;
    border: none;
    transition: 0.5s;
    color: white;
    
}
.card-1 {
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}
.card-1:hover {
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}
.card-horizontal {
    display: flex;
    flex: 1 1 auto;
}
.switch{
  transform: rotate(180deg);
  transition: 0.5s ease-in-out;
  
}
.annonce{
    width: 320px;
    height: 90px;
    margin: 0 auto;
    background-color: #55ae95;
    border: none;
    color: white;
    transition: 0.5s;

}
.compte,.annonce    {
    transform: scale(1.12);
}
*{
    font-family: 'Montserrat', sans-serif;
}

.path{
  transform-origin: 50% 50%;
  stroke-dasharray: 200;
  animation: 1.5s spin ease-in-out infinite,
    6s colors linear infinite;
}

.loader{
  animation: 1.5s rotate linear infinite;
}

@keyframes rotate{
  from{ transform: rotate(0deg); }
  to{ transform: rotate( 270deg); }
}

@keyframes spin{
  0%{ stroke-dashoffset: 200;}
  50% { stroke-dashoffset: 50;
    transform:rotate(135deg); }
  100% { stroke-dashoffset: 200;
    transform:rotate(450deg); }
}

@keyframes colors{
  0% { stroke: #2B85F0; }
  25% { stroke: #E5443C; }
  50% { stroke: #FBB42F; }
  75% { stroke: #009D5B; }
  100% { stroke: #2B85F0; }
}
.loading{
                 display: flex;
                align-items: center;
                justify-content: center;
                background: white;position:absolute;
                width:700px;height:420px;
               
}
@media screen and (max-width: 375px){
    .compte,.annonce{
        width: 280px;   
        margin-bottom: 17px;
        margin-left: 0px;
        align-items: center;
    }
    .loading{
      width: 280px;
      height: 430px;
  }
  .tt{
font-weight: bold;
      font-size: 15px;
  }
  .ttt{
    font-size: 12px;

  }
  .image{
      max-width:140px;
  }
}   
</style>
@section('content')

<div id="app">
<div class="container mt-3">
    <div style="margin-top: 80px" class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <button v-on:click="cm" class="wahd btn btn-dark tex-light btn-block text-center"  > <i class="fa fa-user "></i> Mon Compte<span>
                            <span class="navbar-toggler-icon justify-content-end pull-right"><i class="fas fa-chevron-circle-down"></i></span>
                             
                    </span></button>                   
                    <button v-on:click="an" class="joj btn btn-light text-center btn-block" disabled > <i class="fa fa-mobile" aria-hidden="true"></i> Mes Annonces                            <span class="navbar-toggler-icon justify-content-end pull-right"><i class="fas fa-chevron-circle-down"></i></span>
                    </button>

                   
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8">
            <div v-if="del" class="alert alert-danger my-3" role="alert">
                    item deleted
                  </div>
                  <div v-if="upstatus" class="alert alert-success my-3" role="alert">
                        profile A jour Maintenant
                      </div>
    </div>
       
</div>
</div> 

<div v-if="cmp" class="container mt-3 cmpdiv animated bounceInUp">
    <div class="row justify-content-center">
    <div class="col-md-8">
    <div class="card">
        <div class="card-header" > <i class="fa fa-user"></i> Mon Compte</div>
        <div class="card-body">
            <div class="loading" v-if="ldcm">
                <h2 class="mx-3">Veuillez patientez</h2>
                <svg class="loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" height="100px">
                    <circle class="path" fill="none" stroke="#2B85F0" stroke-width="7" stroke-miterlimit="10" stroke-linecap="square" cx="50" cy="50" r="32"/>
                  </svg>
            </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Name</label>
                                    <input v-model="users.nom"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{Auth::user()->name}}" >
                                    </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input v-model="users.email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{Auth::user()->email}}" >
                          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Telephone</label>
                                <input v-model="users.tele" type="text" class="form-control" value="{{Auth::user()->telephone}}" >
                              </div><div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input v-model="users.pass" type="password" class="form-control" id="exampleInputPassword1" value="{{Auth::user()->password}}" >
                                  </div>
                                  <button class="btn btn-outline-success btn-block" v-on:click="updateuser"> <i class="fa fa-level-up" aria-hidden="true"></i>
                                     Mise a jour</button>

  
        </div>
    </div>
</div>
</div>
</div>


<div v-if="ann" class="container mt-3 anndiv animated bounceInUp ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mes Annonces</div>
            <div class="card-body">
               
                    <h6  v-if="noan">Vous n'avez Pas d'annonce pour le moment</h6>
                    <a  v-if="noan" href="{{url('/annonces')}}" class="btn btn-success">Cree Une Maintenant</a>
               
                <div class="container-fluid" v-for="item in pdt">
                    <div class="row">
                        <div class="col-12 mt-3 m-auto"  >
                            <div class="card card-1" >
                                <div class="card-horizontal">
                                    <div class="img-square-wrapper">
                                        <img style="max-width: 170px;height:100%" class="image " :src="item.photo_article" alt="Card image cap">
                                    </div>
                                    <div class="card-body mx-3 ">
                                    <h4 class="card-title tt">@{{item.nom_article}}</h4>
                                    <p class="card-text ttt">@{{item.description_article}}</p>
                                    <p class="card-text">@{{item.prix_article}} DH</p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Status: @{{item.status}} <span><img style="width: 30px;height: 30px;cursor: pointer" src="https://image.flaticon.com/icons/svg/148/148973.svg" class="pull-right" alt="" v-on:click="deletedt(item.id)">
                                    <img style="width: 30px;height: 30px;cursor: pointer" src="https://image.flaticon.com/icons/svg/189/189677.svg" class="pull-right ml-3" alt="" v-on:click="sold(item.id )" title="vendu">
                                    </span></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            </div>
        </div>
        </div>
        </div>
    </div>
    @endsection
    @section('js')
<script>

    window.laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        'url' => url('/'),
        'idusr' => Auth::user()->id,
        'nomusr' => Auth::user()->name,
        'emailusr' => Auth::user()->email,
        'telusr' => Auth::user()->telephone,
        'passusr' => Auth::user()->password,

    ]) !!};
</script> 
<script>
    new Vue({
        el:"#app",
    data:{
        cmp:false,
        ann:true,
        del:false,
        upstatus:false,
        users:{
            nom: window.laravel.nomusr,
            email:window.laravel.emailusr,
            tele:window.laravel.telusr,
            pass:window.laravel.passusr,
        },
        pdt:[],
        status:"active",
        noan:false,
        ldcm:false,
        
    },
    methods:{
        cm(){
            this.cmp=!this.cmp;     
        },
        an(){
            this.ann=true;
        },  
        getdata(){
            axios.get(window.laravel.url+'/annonces/'+window.laravel.idusr)
            .then(res => {
                this.pdt=res.data;
                console.log(this.pdt);    
                if (this.pdt.length == 0) {
            this.noan=true;
        }    
            });
      
         
        },
        deletedt(i){
            const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
    axios.delete('/api/del/'+i)
            .then(res =>{
                console.log("deleted");
                this.pdt= this.pdt.filter((pf)=>pf.id !== i);
                this.del=!this.del;
                setTimeout(()=>{
                    this.del=!this.del;
                },3000)
                //this.getdata();
                
            })
    swalWithBootstrapButtons.fire(

      'Deleted!',
      'Votre Annonce a ete supprimier',
      'success'
    )
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Votre annonce est pas supprimie',
      'error'
    )
  }
})
         
        },
        updateuser(){
            this.ldcm=!this.ldcm;
            console.log(this.users);
            axios.patch('/api/update/'+window.laravel.idusr,this.users)
            .then(res =>{
                this.ldcm=!this.ldcm;
                this.upstatus=!this.upstatus;
                setTimeout(()=>{
                    this.upstatus=!this.upstatus;
                },3000)

                
            })
        },
        sold(id){
            axios.put('/api/upstatus/'+id)
            .then(data =>{
                console.log("success",data);
                this.status=data.data[0].status;
                this.getdata();
                
                
            })
            
        }
    },
    mounted() {
    this.getdata();
    console.log(this.getdata());
    
    },
        })

</script>


@endsection
