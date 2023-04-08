<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">

        <title>Welcome</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

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
        <a class="navbar-brand" href="#">MyEvents</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('index')}}">Acceuil</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="GET" action="">
           @csrf
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">

        <button class="btn btn-outline-success" style="margin-right:19px;"  id="signup" data-target="#cadre" type="button"> Sign Up</button>
        </form>
        <form class="form-inline my-lg-1" method="GET" action="{{route('loginPage')}}">
           @csrf
        <button class="btn btn-outline-success" type="submit"> Sign In </button>
        </form>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success" role="alert">
                Votre formulaire a été soumis avec succès. Vous recevrez bientôt un code de confirmation par e-mail.
            </div>
        </div>
        <form style="width: 80%;" method="POST" action="{{route('verifyCode')}}">
    @csrf
    <div style="margin-left: 13%;">
    <div class="form-group col-md-6 ">
        <label for="">Saissisez le code</label>
        <div>
            <input id="" type="" name="code"  required >
        </div>
    <div>
        <div>
            <button class="btn btn-primary" type="submit">
                Valider
            </button>
        </div>
    </div>
</div>
</form>

    </div>

</div>
<div id="cadre" class="modal fade">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <p><h5 class="modal-title" style="margin-left:33px;" >Êtes-vous une entreprise ou un client ?</h5></p>
        <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><p><h5 style="color:red;" >Seuls les entreprises quelles soient un organisme ou un particulier peuvent publier des evenements </h5></p>

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
</body>
</html>

