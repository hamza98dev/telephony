@extends('layouts.master')
<style>
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
                width:700px;height:700px;
               
}
@media screen and (max-width: 348px) {
  .loading{
      width: 280px;
      height: 705px;
  }
}
</style>
@section('content')

<div  class="container mt-3 inp animated bounceIn     ">
        
    <div style="margin-top: 80px" class="row justify-content-center">
           
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Deposer Une Annonce</div>
            <div class="card-body">
                <div class="loading" v-if="ld">
                    <h2 class="mx-3">Veuillez patientez</h2>
                    <svg class="loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" height="100px">
                        <circle class="path" fill="none" stroke="#2B85F0" stroke-width="7" stroke-miterlimit="10" stroke-linecap="square" cx="50" cy="50" r="32"/>
                      </svg>
                </div>
                    <div v-if="succ" class="alert alert-success" role="alert" >
                            Article Added with success 
                        </div>
            <form @submit.prevent="senddata" enctype="multipart/form-data">
                   {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputEmail1">Nom Produit</label>
                    <input v-model="prod.nomp" type="text" class="form-control" name="n" required maxlength="40"  >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description Produit</label>
                    <textarea v-model="prod.descp" class="form-control" id="exampleFormControlTextarea1" rows="3" name="de" required></textarea>
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Prix Produit</label>
                    <input v-model="prod.prixp" type="number" class="form-control" name="px" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ville</label>
                    <input v-model="prod.villep" type="text" class="form-control" name="v" required>
                  </div>
                  <div class="form-group">
                    <label for="">Marque de telephone:</label><br>

                    <select class="form-control" v-model="prod.mf">
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
                  <div class="form-group">
                    <label for="exampleInputEmail1">photo Produit 1</label>
                    <input @change="processFile1" type="file" class="form-control my-2" accept="image/*"  required >
                  </div>
                  <div class="form-group">
                        <label for="exampleInputEmail1">photo Produit 2</label>
                        <input @change="processFile2" type="file" class="form-control my-2" accept="image/*"  required >
                      </div>
                      {{-- <div class="form-group">
                            <label for="exampleInputEmail1">photo Produit 3</label>
                            <input @change="processFile3" type="file" class="form-control my-2" required >
                          </div> --}}
                          {{-- <div class="form-group">
                                <label for="exampleInputEmail1">photo Produit 4</label>
                                <input @change="processFile4" type="file" class="form-control my-2" required >
                              </div> --}}
                     
                  <input v-model="prod.idUser" type="hidden" name="idUser" value="{{ Auth::user()->id }}">
                  <button :disabled="ssub" type="submit" class="btn btn-outline-primary btn-block" >Desposer Maintenant</button>
                


               </form>
                
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
            'idusr' => Auth::user()->id
        ]) !!};
    </script> 

     
    <script>
    new Vue({
        el:".inp",
        data(){
            return{
                prod:{
                nomp:'',
                descp:'',
                prixp:'',
                villep:'',
                mf:'',
                photop1:'',
                photop2:'',
                photop3:'',
                photop4:'',
            
                idUser:window.laravel.idusr
                },
                succ:false,
                 fail:false,
                 ssub:false,
                 ld:false,
              

            };
        },
        methods:{
            processFile1(e) {        
                let files1 = e.target.files || e.dataTransfer.files;
                if (!files1.length)
                    return;
                this.createImage1(files1[0]);
                console.log(e.target.files || e.dataTransfer.files);
                
                
            },
            createImage1(file1) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.prod.photop1 = e.target.result;
                };
                reader.readAsDataURL(file1);
            },

            processFile2(e) {        
                let files2 = e.target.files || e.dataTransfer.files;
                if (!files2.length)
                    return;
                this.createImage2(files2[0]);
                console.log(e.target.files || e.dataTransfer.files);
                
            },
            createImage2(file2) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.prod.photop2 = e.target.result;
                };
                reader.readAsDataURL(file2);
            },
            processFile3(e) {        
                let files3 = e.target.files || e.dataTransfer.files;
                if (!files3.length)
                    return;
                this.createImage2(files3[0]);
                console.log(e.target.files || e.dataTransfer.files);
                
            },
            createImage3(file3) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.prod.photop3 = e.target.result;
                };
                reader.readAsDataURL(file3);
            },
            processFile4(e) {        
                let files4 = e.target.files || e.dataTransfer.files;
                if (!files4.length)
                    return;
                this.createImage2(files4[0]);
                console.log(e.target.files || e.dataTransfer.files);
                
            },
            createImage4(file4) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.prod.photop4 = e.target.result;
                };
                reader.readAsDataURL(file4);
            },
            senddata(){
                this.ld=!this.ld;
                console.log(this.prod);
                this.ssub=!this.ssub;
                axios.post('/api/postr/', this.prod)
                .then(res =>{
                    this.ld=!this.ld;
                    Swal.fire(
  'Felicitation!',
  'Votre Article est Maintenant Active',
  'success'
)


                this.succ=!this.succ;
                this.prod.nomp='';
                this.prod.descp='';
                this.prod.villp='';
                this.prod.prixp='';
                this.prod.photop1='';
                this.prod.photop2='';
                this.prod.photop3='';
                this.prod.photop4='';
                setTimeout(()=>{
                    this.succ=!this.succ;
                },1000)

                })
                },
            }
        })
    
    </script>
@endsection