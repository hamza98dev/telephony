@extends('layouts.master')
<style>
*{
    font-family: 'Montserrat', sans-serif;

  }
  .card{
      transition: 1s;
  }
  .card:hover{
      
      transform: scale3d(1.05, 1.05, 4);
      z-index: 3;
      font-size: 10px;
      box-shadow: 2px 2px 2px 2px lightslategrey;
  }


</style>
@section('content')
    <div id="app" class="container my-3">
        <div style="margin-top: 80px" class="row">
            
                <div class="col-md-6">
                        <div style="" class="card border-danger  overflow-auto w-100">
                            <div style="position: sticky" class="card-header">Annonces</div>
                            <div  class="card-body p-0 m-0">
                                <table  class="table justify-content-center ">
                                    <thead class="bg-danger text-light">
                                        <th>nom article</th>
                                        <th>prix Artcile</th>
                                        <th>ajoutez le</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody class="justify-content-center" v-for="an in annonce">
                                    <td>@{{an.nom_article}}</td>
                                    <td>@{{an.prix_article}}</td>
                                    <td>@{{an.created_at}}</td>
                                    <td>@{{an.status}}</td>
                                    <td>
                                            <button v-on:click="dalan(an.id)" class="btn btn-danger btn-sm" ><i class="fas fa-trash-restore"></i></button>
                                        </td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

            <div class="col-md-6">
                <div style="" class="card border-primary  overflow-auto w-100">
                    <div style="position: sticky" class="card-header">Utilisateurs</div>
                    <div  class="card-body p-0 m-0">
                        <table  class="table ">
                            <thead class="bg-primary text-light">
                                <th>name</th>
                                <th>email</th>
                                
                                <th>tele</th>
                                <th>Action</th>
                            </thead>
                            <tbody v-for="us in user">
                            <td>@{{us.name}}</td>
                            <td>@{{us.email}}</td>
                            <td>@{{us.telephone}}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" v-on:click="dalus(us.id)"><i class="fas fa-trash-restore"></i></button>
                            </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <canvas class="mt-3" id="myChart" style="width: 100%;height: 400px"></canvas>



    </div>
    
@endsection
@section('js')
<script>
        var mavue = new Vue({
            el:"#app",
            data :{
                    annonce:[],
                    user:[],
                    chart:[],
                    pusher:[],
            },
            methods:{
                  getdata(){
                    axios.get('/api/admindata')
            .then(data =>{
               this.annonce=data.data.annonces;
               this.user=data.data.users;


                console.log(this.user);
                console.log(this.annonce);
                
                
                
            });
        },
        dalan(adid){
            axios.delete('api/addel/'+adid)
            .then(data=>{
                console.log("deleted");
                this.annonce= this.annonce.filter(a => a.id !== adid);
            })
        },
        dalus(idu){
            axios.delete('api/addelus/'+idu)
            .then(data=>{
                console.log("deleted");
                this.user= this.user.filter(a => a.id !== idu);
            })
        },
        getgraph(){
            axios.get('/api/graph')
            .then(data =>{
                this.chart=data.data;
                console.log(this. chart);
                this.chart.forEach(element => {
                    this.pusher.push(element[0].counter);
                    console.log(this.pusher);
                    
                    
                });
                
                var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi','Samedi'],
        datasets: [{
            label: 'Annonces Per Day',
           
            data: [this.pusher[0],this.pusher[1],this.pusher[2],this.pusher[3],this.pusher[4],this.pusher[5],this.pusher[6]] ,
            
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

                
            })
        }

            },
            mounted(){
                    this.getdata();
                    this.getgraph();
    
            }
        });
       
    </script>    
@endsection

