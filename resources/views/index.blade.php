@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')

@section('body')
<div class="card mb-5" style="position:absolute; width:1226px">
  <img class="card-img-center" style="height:333px;" src="{{ asset('images/acc.png') }}" alt="Card image cap">
</div>
  <div class="card-body" style="position:relative;">
    <h1 class="card-title" style="color:white; margin-top:91px; margin-left:475px;">All In One</h1>
    <h3 class="card-text" style="color:black; margin-left:235px;">La facilité dans la création des moments magiques......</h3>
    <a href="{{ route('allEvents') }}"  class="btn btn-outline-light w-20 my-3 my-sm-0" style="color:black; font-weight:500px;  margin-left:435px;">Parcourir tous les evenements >></a>
  </div>

  <div class="card-body" style=" margin-top:81px; position:absolute;">
    <span class="card-text" style="color:tomato; margin-left:255px; font-size: larger;">Explorer les evenements par categorie</span>
    <span>
        <select style="margin-left:31px;" class="btn btn-info" onchange="window.location.href=this.value">
        @foreach ($categories as $categorie)
        <?php // dd($categories) ?>
            <option value="{{ route('eventCategory',  $categorie->id) }}">{{$categorie->libelle}}</option>
        @endforeach
        </select>
    </span>

  </div>
  <div class="row" style="margin-left:61px;  margin-top:91px; width:85%;">
    <div class="col-md-3" style="margin-top:111px; width:211px; border-radius:19px;"  >
        <div class="card">
            <img class="card-img-top" src="{{ asset('images/cat/carnaval.png') }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title" >Carnaval</h5>
                <p class="card-text">Explorer les evenements de la categorie carnaval.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col-md-3" style="margin-top:111px; width:211px; border-radius:19px;"  >
        <div class="card">
            <img class="card-img-top" src="{{ asset('images/cat/sportif.png') }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title" >Sportif</h5>
                <p class="card-text">Explorer les evenements de la categorie sport.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col-md-3" style="margin-top:111px; width:211px; border-radius:19px;"  >
        <div class="card">
            <img class="card-img-top" src="{{ asset('images/cat/detente.png') }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title" >Detente</h5>
                <p class="card-text">Explorer les evenements de la categorie detente.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col-md-3" style="margin-top:111px; width:211px; border-radius:19px;"  >
        <div class="card">
            <img class="card-img-top" src="{{ asset('images/cat/chill.png') }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title" >Chills</h5>
                <p class="card-text">Explorer les evenements de la categorie chills.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
<hr>
    </div>

@endsection
