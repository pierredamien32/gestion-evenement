@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')

@section('body')
<?php use Illuminate\Support\Carbon; ?>


<!--img style="position: absolute;" src="{{ asset('images/fond.png') }}" alt=""-->

<form style="width: 100%; background-image:url; " method="GET" action="{{ route('reservation') }}">
@csrf
<div style="margin-left: 13%;">
<div class="">
      <input type="hidden" value="{{ Session::get('eventRes') }}" class="form-control" name="evenement_id">
      <input type="hidden" value="{{ auth()->user()['id']}}" class="form-control" name="user_id">
    </div>
        <input type="hidden" class="form-control" value="{{Carbon::now()->format('Y-m-d')}}" id="dateRes" name="dateRes" required>
    </div>
<h3 style="text-align: center;">Vous etes sur le point de reserver pour un evenement: si vous souhaitez continuer passez a letape suivante</h3>
</div>
<button type="submit" style="margin-left: 45%;"class="btn btn-primary">Suivant</button>
</div>
</div>
</form>


<script>

</script>
@endsection
