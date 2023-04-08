@extends(auth()->user()['role_id']==1 || auth()->user()['role_id']==3 ? 'admin/superPage' : 'welcome')

@section('body')
    <div class="container">
        <h2>Notifications</h2>
        <hr>
        @if(count($notifications) > 0)
                @foreach($notifications as $notification)
                
                <div class="card row" style="width: 23rem;">
                    <div class="card-body">
                        <h5 class="card-title">Email:<strong>{{ $notification->data['email'] }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Une {{ $notification->data['role'] }} vient de sinscrire</h6>
                        <p class="card-text">Nom: {{$notification->data['nom']}}</p>
                        <p class="card-text">Prenom: {{$notification->data['prenom']}}</p>
                        <p class="card-text">Sigle: {{$notification->data['sigle']}}</p>
                        <p class="card-text">Denomination: {{$notification->data['sociale']}}</p>
                        <p class="card-text">IFU: {{$notification->data['ifu']}}</p>
                        <p class="card-text">Adresse: {{$notification->data['adresse']}}</p>
                        <p class="card-text">Pays: {{$notification->data['pays']}}</p>
                        <p class="card-text">Contact: {{$notification->data['tel']}}</p>
                        <p class="card-text">Telephone: {{$notification->data['fixe']}}</p>
                        <p class="card-text">Description: {{$notification->data['description']}}</p>
                        <form class="form inline-flex" action="{{ route('markAsRead', ['id' => $notification->id])}}" method="POST">
                            @csrf
                            @method('GET')
                            <button type="submit" class="btn btn-success border-t-green-700">Valider</button>
                        </form>
                        <form class="form inline-flex" action="{{ route('markAsReject', ['id' => $notification->id])}}" method="POST">
                            @csrf
                            @method('GET')
                            <button type="submit" class="btn btn-danger border-t-red-700">Rejeter</button>
                        </form>
                    </div>
                </div>
                @endforeach
        @else
            <p>No notifications.</p>
        @endif
    </div>
@endsection
