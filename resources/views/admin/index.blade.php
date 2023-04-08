<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">

        <title>Admin</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <!-- Styles -->

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
                <a class="nav-link" href="index">Acceuil</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{route('allEvents')}}">Evenements</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="GET" action="{{route('adminLoginForm')}}">
           @csrf
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        @if(Session::has('user_name'))
        <select style="margin-right:13px" class="btn btn-outline-primary w-20 my-3 my-sm-0" onchange="window.location.href=this.value">
            <option value="">{{ Session::get('user_name') }}</option>
            <option value="{{route('formEntrepriseAdmin')}}">Creer Entreprise</option>
            @if(auth()->check() && auth()->user()['role_id']==1)
            <option value="{{route('adminForm')}}"> Creer Administrateur</option>
            @endif
            <option value="{{route('adminNotification')}}">Notifications</option>
            <option value="{{route('formEvent')}}">Creer un evenement</option>
        </select>
        @endif
        </form>
        <form class="form-inline my-lg-1" method="POST" action="{{route('adminLogout')}}">
           @csrf
        <button class="btn btn-outline-danger w-20 my-3 my-sm-0" style="margin-right:13px;" type="submit"> Log out</button>
        </form>
    </div>
</nav>
    @yield('body')
    <div class="card mb-5" style="position:absolute; width:1199px">
  <img class="card-img-center" style="height:333px;" src="{{ asset('images/acc.png') }}" alt="Card image cap">
</div>
  <div class="card-body" style="position:relative;">
    <h1 class="card-title" style="color:orange; margin-top:91px; margin-left:435px;">All In One</h1>
    <h3 class="card-text" style="color:black; margin-left:235px;">La facilité dans la création des moments magiques......</h3>
    <a href="{{route('allEvents')}}" class="card-text" style="color:black; margin-left:435px;">Parcourir tous les evenements</a>
  </div>
  <div class="card-body" style=" margin-top:81px; position:absolute;">
    <h3 class="card-text" style="color:tomato; margin-left:235px;">Explorer les evenements par categorie</h3>
    <span>
        <select style="margin-right:13px" class="btn btn-outline-primary w-20 my-3 my-sm-0" onchange="window.location.href=this.value">
        @foreach {{$categories as $key =>$categorie}}
        <?php dd($key) ?>
            <option value="{{route('$categorie->$key->id')}}">{{$categorie->libelle}}</option>
        @endforeach
        </select>
    </span>
  </div>
  <div class="row" style="margin-left:61px; width:85%;">
    <div class="col-md-3" style="margin-top:111px; width:211px; border-radius:19px;"  >
        <div class="card">
            <img class="card-img-top" src="{{ asset('images/cat/carnaval.png') }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title" >Carnaval</h5>
                <p class="card-text">Explorer les evenements de la categorie carnaval.</p>
                <a href="" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col-md-3" style="margin-top:111px; width:211px; border-radius:19px;"  >
        <div class="card">
            <img class="card-img-top" src="{{ asset('images/cat/sportif.png') }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title" >Sportif</h5>
                <p class="card-text">Explorer les evenements de la categorie sport.</p>
                <a href="" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col-md-3" style="margin-top:111px; width:211px; border-radius:19px;"  >
        <div class="card">
            <img class="card-img-top" src="{{ asset('images/cat/detente.png') }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title" >Detente</h5>
                <p class="card-text">Explorer les evenements de la categorie detente.</p>
                <a href="" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col-md-3" style="margin-top:111px; width:211px; border-radius:19px;"  >
        <div class="card">
            <img class="card-img-top" src="{{ asset('images/cat/chill.png') }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title" >Chills</h5>
                <p class="card-text">Explorer les evenements de la categorie chills.</p>
                <a href="" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
<hr>
    </div>
</body>
</html>
