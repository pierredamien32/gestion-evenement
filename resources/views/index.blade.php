@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')

@section('body')
<div class="card mb-5 col-md-12" style="position:absolute;">
    <img class="card-img-center img-fluid mx-auto" style="width:100%;" src="{{ asset('images/acc.png') }}" alt="Card image cap">
</div>
  <div class="container">
    <div class="row">
        <div class="col-md-12" >
            <h1 class="card-text col-md-12 d-flex align-items-center" style="width: 684px; margin-top: 150px; height: 153px; font-weight: 900; font-size: 45px; line-height: 54px; color: #FFFFFF;">Un outil tout-en-un pour la gestion d’évènement réussis</h1>
            <a href="{{ route('allEvents') }}"  class="btn btn-light btn-lg rounded-pill p-3 " style="color: #FF8B03;font-style: normal;weight: 800;font-size: 24px;line-height: 29px;">Parcourir les evenements >></a>
        </div>
    </div>
  </div>
  <div class="card-body " style=" margin-left:96px; margin-top:200px; position:absolute;">
    <span class="card-text" style="font-style: normal;font-weight: 700;font-size: 25px;line-height: 30px;color: #000000;">Explorer les evenements par categorie</span>
    <span>
        <select style="margin-left:31px;" class="btn btn-info" onchange="window.location.href=this.value">
        @foreach ($categories as $categorie)
        <?php // dd($categories) ?>
            <option value="{{ route('eventCategory',  $categorie->id) }}">{{$categorie->libelle}}</option>
        @endforeach
        </select>
    </span>
  </div>
  <div class="row mx-auto " style="margin-top:200px; width:90%;">
    <div class="col-md-3" style="margin-top:111px; width:211px; border-radius:19px;"  >
        <div class="card">
            <img class="card-img-center img-fluid mx-auto" src="{{ asset('images/cat/carnaval.png') }}" alt="Card image cap" style="width:80%; height:200px;">
            <div class="card-body">
                <h5 class="card-title" >Carnaval</h5>
                <p class="card-text">Explorer les evenements de la categorie carnaval.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col-md-3" style="margin-top:111px; width:211px; border-radius:19px;"  >
        <div class="card">
            <img class="card-img-center img-fluid mx-auto" src="{{ asset('images/cat/sportif.png') }}" alt="Card image cap" style="width:80%; height:200px;">
            <div class="card-body">
                <h5 class="card-title" >Sportif</h5>
                <p class="card-text">Explorer les evenements de la categorie sport.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col-md-3" style="margin-top:111px; width:211px; border-radius:19px;"  >
        <div class="card">
            <img class="card-img-center img-fluid mx-auto" src="{{ asset('images/cat/detente.png') }}" alt="Card image cap" style="width:80%; height:200px;">
            <div class="card-body">
                <h5 class="card-title" >Detente</h5>
                <p class="card-text">Explorer les evenements de la categorie detente.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col-md-3" style="margin-top:111px; width:211px; border-radius:19px;"  >
        <div class="card">
            <img class="card-img-center img-fluid mx-auto" src="{{ asset('images/cat/chill.png') }}" alt="Card image cap" style="width:80%; height:200px;">
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
