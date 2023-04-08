@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')

@section('body')
<form style="width: 100%; background-image:url; " method="GET" action="{{ route('createReservationEvent') }}">
@csrf
<div style="margin-left: 13%;">
<div id="champs" class="form-group col-md-6">
      <label for="">Niveau dacces</label>
      <select name="libelle[]" class="form-control">
        @foreach ($nivacces as $niv)
            <option value="{{ $niv->id }}">{{ $niv->libelle }}</option>
        @endforeach
      </select>
      <label for="">Nombre de Places</label>
      <input type="number" class="form-control" name="nbPlaces[]" id="">
</div>
    <div>
        <button type="button" class="btn btn-secondary" id="niveau">Reserver pour un autre niveau?</button>
    </div>
    <div>
        <button type="submit" class="btn btn-primary" id="">Suivant</button>
    </div>
    </form>
<div id="cadrez" class="modal fade">
<form action="{{route('addNivAcces')}}" style="width:55%" method="get">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div>
        <h5 class="modal-title">Nom du niveau dacces</h5>
        </div>
        <button type="button" class="close" id="closez" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-body">
        <div><input name="libelle" type="text"></div>
        <button class="btn btn-success" type="submit" style="margin-left: 154px;">Ajouter</button>
      </div>
    </div>
  </div>
  </form>
</div>

<script>
        var niveau = document.querySelector('#niveau');

        niveau.addEventListener('click',
        function t(e) {
            var champs = document.getElementById("champs");
            var champ = document.createElement("div");
            champ.classList.add("champ");
            champ.innerHTML = `
                <select name="libelle[]" class="form-control">
                    @foreach ($nivacces as $niv)
                        <option value="{{ $niv->id }}">{{ $niv->libelle }}</option>
                    @endforeach
                </select>
                <label for="">Nombre de Places</label>
                <input type="number" class="form-control" name="nbPlaces[]" id="">
            `;
            champs.appendChild(champ);
        });

</script>

@endsection
