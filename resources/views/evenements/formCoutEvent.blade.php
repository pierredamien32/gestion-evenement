@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')

@section('body')
<form style="width: 100%; background-image:url; " method="GET" action="{{ route('createCoutEvent') }}">
@csrf
<div style="margin-left: 13%;">
<div id="champs" class="form-group col-md-6">
      <label for="">Niveau dacces</label>
      <select name="libelle[]" class="form-control">
        @foreach ($nivacces as $niv)
            <option value="{{ $niv->id }}">{{ $niv->libelle }}</option>
        @endforeach
      </select>
      <label for="">Cout</label>
      <input type="number" class="form-control" name="cout[]" id="">
      <span>Le niveau nest pas dans la liste?</span>
      <button type="button" class="btn btn-primary" id="ajouter">+ Ajouter</button>
</div>
    <div>
        <button type="button" class="btn btn-secondary" id="niveau">Autres couts?</button>
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
        var ajouter = document.querySelector('#ajouter');
        var niveau = document.querySelector('#niveau');

        ajouter.addEventListener('click',
        function t(e) {
            document.getElementById("cadrez").classList.add("show");
            document.getElementById("cadrez").style.display = "block";
            modalBackdrop.classList.add("modal-backdrop", "fade", "show");
            document.body.appendChild(modalBackdrop);
        });

        var closeBtn = document.querySelector('#closez');

        // Ajouter un événement de clic à l'icône de fermeture
        closeBtn.addEventListener('click', function() {
            document.getElementById("cadrez").style.display = "none";
            modalBackdrop.classList.remove("modal-backdrop", "fade", "show");
        }) ;

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
                <label for="">Cout</label>
                <input type="number" class="form-control" name="cout[]" id="">
            `;
            champs.appendChild(champ);
        });

</script>


@endsection
