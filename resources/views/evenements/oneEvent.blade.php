
@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')
@section('body')
    <div class="container text-center list-item">
        <?php
            use Illuminate\Support\Facades\Session;
            Session::put('eventRes', $evenement->id);
        ?>
        <div class="card">
            <div class="card-header" style="height: 111px;">
                @if($evenement->statut ==='A venir')
                <span><a href="#" class="btn btn-primary btn-lg disabled" role="button" aria-disabled="true">{{ $evenement->statut}}</a></span>
                <span style="font-size: 45px;" class="card-title"> {{ $evenement->intitule}}</span>
                <a href="{{route('reserver')}}" style="margin-left: 999px; margin-top:3px;" type="button" class="btn btn-success">Reserver</a>
                @endif
                @if($evenement->statut ==='En cours')
                <span><a href="#" class="btn btn-success btn-lg disabled" tabindex="-1" role="button" aria-disabled="true">{{ $evenement->statut}}</a></span>
                <span style="font-size: 45px;" class="card-title"> {{ $evenement->intitule}}</span>
                <a  href="{{route('reserver')}}" style="margin-left: 999px; margin-top:3px;" type="button" class="btn btn-success">Reserver</a>

                @endif
                @if($evenement->statut ==='Passe')
                <span><a href="#" class="btn btn-danger btn-lg disabled" tabindex="-1" role="button" aria-disabled="true">{{ $evenement->statut}}</a></span>
                @endif

            </div>
            <div class="card-body">
                <h3 class="card-subtitle mb-2 text-muted">{{ $evenement->dateDebut }} à {{ $evenement->heure }}</h3>
                <p class="card-text">{{ $evenement->description }}</p>
                <h4>Informations générales</h4>
                <ul>
                    Lieu : {{ $evenement->lieu }} <br>
                    Catégorie : {{ $evenement->categorie->libelle }} <br>
                    @if($evenement->role_id==1 ||$evenement->role_id==3 )
                    Entreprise : {{ $evenement->utilisateur['nom'] }}
                    @endif
                    @if($evenement->role_id==2 ||$evenement->role_id==4 )
                    Entreprise : {{ $evenement->entreprise['sigle'] }}
                    @endif
                </ul>
                <h4>Prix</h4>
                <ul>
                    @foreach ($evenement->niveaux as $ticket)
                        {{ $ticket->libelle }} - {{ $ticket->pivot->cout }}FCFA <br>
                    @endforeach
                </ul>
                <h4>Images et vidéos</h4>
                <div class="row">
                    @foreach ( $evenement->images as $image)
                        <div class="col-md-4">
                            <img src="image/{{$image->titre}}" alt="{{ $image->titre }}" class="img-fluid">
                        </div>
                    @endforeach
                </div>
                <h4>Sponsors</h4>
                <ul>
                    @foreach ( $evenement->sponsors as $sponsor)
                        {{ $sponsor->nom }} <br>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
