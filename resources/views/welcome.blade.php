<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <title>AllinOne</title>
<!-- CSS -->
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxxxxx" crossorigin="anonymous" />
        
        <!-- Styles -->
        <!-- Inclure la bibliothèque Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <body >
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img src="{{ asset('images/logo.png') }}" style="width: 99px; height:55px;" alt="">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('index')}}" style="font-style: normal;font-weight: 700;font-size: 16px;line-height: 19px;color: #777777;">Acceuil</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{route('allEvents')}}" style="font-style: normal;font-weight: 700;font-size: 16px;line-height: 19px;color: #777777;">Evenements</a>
            </li>
        </ul>
        @if(Session::has('user_name'))
        <form class="form-inline my-2 my-lg-0" method="GET" action="{{route('searchEvents')}}">
           @csrf
        <input class="form-control mr-sm-2" type="search" name="value" id="value" placeholder="Search" aria-label="Search">

        <select style="margin-right: 15px;" class="btn btn-primary"  onchange="window.location.href=this.value" >
            <option value="">{{ Session::get('user_name')}}</option>
            <option value="{{route('index')}}">Mon Profil</option>
            @if(auth()->check() && (auth()->user()['role_id'] !==5 ))
            <option value="{{route('formEvent')}}">Creer un evenement</option>
            <option value="{{ route('myEvents', auth()->user()['id']) }}">Mes evenements</option>
            @endif
            <option value="{{route('index')}}">Mes Notifications</option>
            <option value="{{route('index')}}">Mes Reservations</option>
        </select>

        </form>
        <form class="form-inline my-lg-1" method="POST" action="{{route('logout')}}">
           @csrf
        <button class="btn btn-outline-danger" style="margin-right: 15px;" type="submit"> Log out</button>
        </form>
        @else
        <form class="form-inline my-2 my-lg-0" method="GET" action="{{route('searchEvents')}}">
           @csrf
        <input class="form-control mr-sm-2" type="search" name="value" placeholder="Search" aria-label="Search">

        <button class="btn btn-outline-primary rounded-pill px-4" style="margin-right:19px;"  id="signup" data-target="#cadre" type="button"> Sign Up</button>
        </form>
        <form class="form-inline my-lg-1" method="GET" action="{{route('loginPage')}}">
           @csrf
        <button class="btn btn-outline-primary rounded-pill px-4" type="submit"> Sign In </button>
        </form>
        @endif
    </div>
</nav>
<div id="cadre" class="modal fade">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <p><h5 class="modal-title" style="margin-left:33px;" >Êtes-vous une entreprise ou un client ?</h5></p>
        <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><p><h5 style="color:red; text-align:center" >Seuls les entreprises quelles soient un organisme ou un particulier peuvent publier des evenements </h5></p>

      <div class="modal-body">
        <a class="btn btn-primary" style="margin-left:33px;" href="{{route('formEntreprise')}}">Entreprise</a>
        <a class="btn btn-primary" style="margin-left: 184px;" href="{{route('formClient')}}">Client</a>
      </div>
    </div>
  </div>
</div>

    @yield('body')

    <script>
        var signup = document.querySelector('#signup');
        var modal = document.getElementById("modal");
        var modalBackdrop = document.createElement("div");

        signup.addEventListener('click',
        function t(e) {
            document.getElementById("cadre").classList.add("show");
            document.getElementById("cadre").style.display = "block";
            modalBackdrop.classList.add("modal-backdrop", "fade", "show");
            document.body.appendChild(modalBackdrop);
        })

        var closeBtn = document.querySelector('#close');

        // Ajouter un événement de clic à l'icône de fermeture
        closeBtn.addEventListener('click', function() {
            document.getElementById("cadre").style.display = "none";
            modalBackdrop.classList.remove("modal-backdrop", "fade", "show");
        }) ;
    </script>
    <footer class="container-fluid bg-primary p-3 mt-5">
      <div class="row">
        <p class="" style="bottom: 20px;left: 20px;"><a href="#" class="text-light">Haut de page</a></p>
        <p class="col-12 text-center" style="font-style: normal;font-weight: 700;font-size: 20px;line-height: 30px;">&copy; 2017–2023 Company, Inc. &middot; <a href="#" class="text-light">Privacy</a> &middot; <a href="#" class="text-light">Terms</a></p>
      </div>
    </footer>



    <script src="{{asset('js/holder.js')}}" ></script>
</body>
</html>
