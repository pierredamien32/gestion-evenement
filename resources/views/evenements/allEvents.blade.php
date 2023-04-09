@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')

@section('body')
<div class="row" style="margin-left:11px; margin-top:1px; width:99%;">
@if(!$evenements->count())
<h3 class="col-12 text-center" style=""> Aucun evenement trouvé </h3>
<svg class="mx-auto text-center" style="width:50px; text-align: center;" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>emoji_sad_circle [#542]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-300.000000, -5799.000000)" fill="#000000"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M259,5645.415 C259.552,5645.415 260,5645.863 260,5646.415 L260,5648.415 C260,5648.967 259.552,5649.415 259,5649.415 L257,5649.415 C256.45,5649.415 256,5648.965 256,5648.415 L256,5646.415 C256,5645.863 256.448,5645.415 257,5645.415 L259,5645.415 Z M252,5648.415 C252,5648.967 251.552,5649.415 251,5649.415 L249,5649.415 C248.45,5649.415 248,5648.965 248,5648.415 L248,5646.415 C248,5645.863 248.448,5645.415 249,5645.415 L251,5645.415 C251.552,5645.415 252,5645.863 252,5646.415 L252,5648.415 Z M249.107,5654.164 C250.114,5649.027 257.886,5648.923 258.893,5654.061 C259.01,5654.66 258.513,5655.415 257.902,5655.415 L257.885,5655.415 C257.409,5655.415 257.019,5654.967 256.91,5654.504 C256.219,5651.58 251.781,5651.477 251.09,5654.4 C250.981,5654.864 250.591,5655.415 250.115,5655.415 L250.098,5655.415 C249.487,5655.415 248.99,5654.763 249.107,5654.164 L249.107,5654.164 Z M254,5657 C249.589,5657 246,5653.411 246,5649 C246,5644.589 249.589,5641 254,5641 C258.411,5641 262,5644.589 262,5649 C262,5653.411 258.411,5657 254,5657 L254,5657 Z M254,5639 C248.477,5639 244,5643.477 244,5649 C244,5654.523 248.477,5659 254,5659 C259.523,5659 264,5654.523 264,5649 C264,5643.477 259.523,5639 254,5639 L254,5639 Z" id="emoji_sad_circle-[#542]"> </path> </g> </g> </g> </g></svg>
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
