<style>
.switch{
  transform: rotate(180deg);
  transition: 0.5s ease-in-out;
  
}
 
</style>
<div id="navinfo">
  <nav  style="color: black"  class="navbar navbar-expand-lg bg-light fixed-top animated fadein">
    
    <a style="  font-family: 'El Messiri', serif;font-weight: bold" class="navbar-brand text-dark" href="/">تيليفوني</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"><i class="fas fa-chevron-circle-down"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">

        <li class="nav-item">
        <a style="  font-family: 'Montserrat', sans-serif;" class="nav-link  mx-2 text-dark " href="{{url('/annoncesshow')}}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Annonces</a>
        </li>
        <li class="nav-item">
        <a style="  font-family: 'Montserrat', sans-serif;" class="nav-link  mx-2 text-dark " href="{{url('/annonces')}}"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Deposer Une Annonces</a>
        </li>
          @if(Auth::check() && Auth::user()->is_admin)

              <li class="nav-item">
                  <a style="  font-family: 'Montserrat', sans-serif;" class="nav-link mx-2 text-dark" href="{{url('/dashboard')}}"><i class="fa fa-lock" aria-hidden="true"></i> Admin Dashboard</a>
              </li>
              <li class="nav-item">
                <a style="  font-family: 'Montserrat', sans-serif;" class="nav-link mx-2 text-dark" href="{{url('/emails')}}"><i class="fas fa-sms"></i> Emails</a>
            </li>
          @endif
        
        <li class="nav-item dropdown">

          <a style="  font-family: 'Montserrat', sans-serif;" class="nav-link dropdown-toggle  mx-2 text-dark" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @if (Auth::check())
          <i class="fas fa-user"></i>  {{Auth::user()->name}}
          @else
          <i class="fas fa-user-circle"></i> Mon Compte
          @endif

          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

            @if (Auth::check())
            <a class="dropdown-item" href="/register"> <i class="fa fa-user"></i> Mon Compte</a>
            <a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Se Deconnecter</a>

            @else
              <a class="dropdown-item" href="/login"><i class="fas fa-sign-in-alt"></i> Se Connecter</a>
              <a class="dropdown-item" href="/register"><i class="fas fa-arrow-right"></i> S'inscrire</a>



            @endif
          



          </div>

        </li>
      </ul>
   
    </div>


  </nav> 


</div>
<script>
$('.navbar-toggler').click(function(){
$('.fa-chevron-circle-down').toggleClass('switch');
})
</script>
