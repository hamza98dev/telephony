@extends('layouts.master')
<style>
  

.contact-form{
    margin-top: 10%;
    border-top: 1px solid black;
    margin-bottom: 5%;
  
    width: 100%;
}
.contact-form .form-control{
    border-radius:0,5rem;
}

.contact-form form{
    padding: 14%;
}
.contact-form form .row{
    margin-bottom: -7%;
}
.contact-form h3{
    margin-bottom: 8%;
    margin-top: -10%;
    text-align: center;
    color: #0062cc;
}
.contact-form .btnContact {
    width: 50%;
    border: none;
    border-radius: 1rem;
    padding: 1.5%;
    background: #dc3545;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
}
.btnContactSubmit
{
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    color: #fff;
    background-color: #0062cc;
    border: none;
    cursor: pointer;
}
h1{
  color: white;
  text-align: center;
  font-family: 'Montserrat', sans-serif;
font-size: 100vh;


}
.edd{
  margin-top: 120px;
  border: 1px Solid white;
  background-color: transparent;
  color: white;
  font-weight: bold;
  transition: 0.7s;
  width: 224px;
  height: 69px;
  
}
.edd:hover{
  transform: scale(1.14);
  background-color: white;
  color: black;
  border: 1px solid black;
  border-radius: 0px;
}
img{
  width: 350px;
  height: 350px;
  margin-left: 50px;
}
</style>
@section('content')

  <div style=" height:600px ;background-image:url(https://res.cloudinary.com/practicaldev/image/fetch/s--chSFwWFH--/c_limit%2Cf_auto%2Cfl_progressive%2Cq_auto%2Cw_880/https://thepracticaldev.s3.amazonaws.com/i/izwiuokylo3m0g4utn88.png);background-size:cover;background-repeat:no-repeat;background-position:center" class="row">
    <div style="margin-top: 200px;"  class="col-md-12 text-center">
      <h1 style="font-weight: bold;font-family: 'El Messiri', serif;" class="animated slideInLeft slow ">بيع و شري تلفون لي بغيتي</h1>
      <a href="{{url('/annoncesshow')}}" style="text-decoration: none"><button  class=" edd btn-lg animated flipInX slow my-3"> <i class="fa fa-shopping-bag" aria-hidden="true"></i> ANNONCES</button></a>
    </div>
  </div>

  
  <div class="container text-center">
    <h1 style="color: black" class="mt-3" style="font-weight: bold">Notre Services</h1>
    <div style="margin-top: 70px" class="row">
      <h6></h6>
      <div  class="col-md-4 my-3 "> 
        <img class="animated  rotatein" style="width: 80px;height: 80px;margin: auto" src="https://image.flaticon.com/icons/svg/1306/1306925.svg" alt="">
        <h3 style="text-align: center;">Securité</h3>
        <p><em>Nous Verifions quotidiennement les annonces publié</em></p>
      </div>
      <div  class="col-md-4 my-3 ">
        <img class="animated  rotatein" style="width: 80px;height: 80px;margin: auto" src="https://image.flaticon.com/icons/svg/1379/1379454.svg" alt="">
        <h3 style="text-align: center;">Satisfaction</h3>
        <p><em>Tous nos utilisateurs sont satisfaits</em></p>
      </div>
      <div class="col-md-4 my-3  ">
        <img class="animated  rotatein" style="width: 80px;height: 80px;margin: auto" src="https://image.flaticon.com/icons/svg/75/75690.svg" alt="">
        <h3 style="text-align: center;">Costumer Support</h3>
        <p><em>disponible 24/24 7/7</em></p>
      </div>
    </div>
    <div class="container contact-form" id="app">
      <form v-on:submit.prevent="sendmessage">
          <h3 style="color: black">Contactez Nous</h3>
         <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                      <input v-model="contact.nom" type="text" name="txtName" class="form-control" placeholder="Your Name *" value="" required />
                  </div>
                  <div class="form-group">
                      <input v-model="contact.email" type="text" name="txtEmail" class="form-control" placeholder="Your Email *" value="" required />
                  </div>
                  <div class="form-group">
                      <input v-model="contact.phone" type="text" name="txtPhone" class="form-control" placeholder="Your Phone Number *" value="" required />
                  </div>
 
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <textarea v-model="contact.message" name="txtMsg" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;" required></textarea>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btnContact"  class="btnContact my-3"> <i class="fas fa-paper-plane"></i>  Send Message</button>
                  </div>
              </div>
  </div>
</div>
@endsection
@section('js')
<script>
new Vue({
  el: '#app',
  data:{
    contact:{
        nom:'',
        email:'',
        phone:'',
        message:'',
    }
  },
  methods:{
    sendmessage(){
        axios.post('/api/contact',this.contact)
        .then(res => {
          Swal.fire(
  'Votre Message a ete envoye',
  'nous vous contacterons dans les plus brefs délais',
  'success'
)
this.contact.nom="";
this.contact.email="";
this.contact.phone="";
this.contact.message="";

        });
        
    }
  }
})
</script>
@endsection