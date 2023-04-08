@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')

@section('body')
    <h3 style="text-align:center">Events</h3>
    @if ($evenements->count())
        <ul >
            @foreach ($evenements as $evenement)
                <li style="text-align:center; text-decoration:none">
                    <a class="link" href="{{route('oneEvent', ['id' => $evenement->id])}}">{{ $evenement->intitule}}</a>
                </li>
            @endforeach
        </ul>


    @else
        <p>No articles found.</p>
    @endif
@endsection
