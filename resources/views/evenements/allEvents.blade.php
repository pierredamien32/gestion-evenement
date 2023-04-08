@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')

@section('body')
<div class="row" style="margin-left:11px; margin-top:1px; width:99%;">
@if(!$evenements->count())
<h3 style="text-align:center"> Aucun evenement trouvé </h3>
@endif
@foreach ($evenements as $key=> $evenement)
    <div class="col-md-3" style="margin-top:111px; width:211px; border-radius:19px;"  >
        <div class="card">
        @if(!$evenement->images)
            <img style="display: none;" class="card-img-top" src="{{ asset('image/'.$evenement->images['titre']) }}" alt="Card image cap">
            @else
            <img class="card" src="image/{{$evenement->firstImage->titre}}" alt="Card image cap">
            @endif
            <div class="card-body">
                <h6 class="card-title">Evenement de la categorie {{ $evenement->categorie->libelle}}</h6>
                <h5 class="card-title">Intitule:{{ $evenement->intitule}} </h5>
                <p class="card-text">Description: {{ $evenement->description }}</p>
                <h6>Sponsors</h6>
                <ul>
                    @foreach ($evenement->sponsors as $sponsor)
                        <li>{{ $sponsor->nom }}</li>
                    @endforeach
                </ul>
                <h6>Prix</h6>
                <ul>
                    @foreach ($evenement->niveaux as $ticket)
                        <li>{{ $ticket->libelle }} - {{ $ticket->pivot->cout }}FCFA</li>
                    @endforeach
                </ul>
                @if($evenement->role_id==1 ||$evenement->role_id==3 )
                <p class="card-text"><small class="text-muted">Publie par: {{$evenement->utilisateur['nom']}} </small></p>
                @endif
                @if($evenement->role_id==2 ||$evenement->role_id==4 )
                <p class="card-text"><small class="text-muted">Publie par: {{$evenement->entreprise['sigle']}} </small></p>
                @endif
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>

                <a href="{{ route('oneEvent', ['id' => $evenement->id]) }}" class="btn btn-primary">En savoir plus>></a>
            </div>
        </div>
    </div>
    <?php //dd($evenement->firstImage->titre)?>

@endforeach
</div>
@endsection
