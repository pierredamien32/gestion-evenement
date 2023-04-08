@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')

@section('body')
<form style="width: 85%; background-image:url; " method="POST" action="{{ route('createImageEvent') }}" enctype="multipart/form-data">
@csrf
<div style="margin-left: 13%;">
<div id="champx" class="form-group col-md-6">
      <label for="">Sponsor</label>
      <select name="nom[]" class="form-control">
        @foreach ($sponsors as $sponsor)
            <option value="{{ $sponsor->id }}">{{ $sponsor->nom }}</option>
        @endforeach
      </select>
      <span>Le sponsor nest pas dans la liste?</span>
      <button type="button" class="btn btn-primary" id="ajouter">+ Ajouter</button>
      <button type="button" class="btn btn-secondary" id="niv">Autres sponsors?</button>

</div>
    <div>
        Voulez-vous ajouter une image?
        <span>
            <button type="button" class="btn btn-success"  id="yes">Oui</button>
        </span>
    </div> <br>
    <div>
        Voulez-vous ajouter une video?
        <span>
            <button type="button" class="btn btn-success"  id="yess">Oui</button>
        </span>
    </div>
<div id="champs" style="display: none;" class="form-group col-md-6">
      <label for="">Image</label>
      <input type="file"  class="form-control-file" name="titre[]" id="">
      <div>
        <button type="button" class="btn btn-secondary" id="niveau">Ajouter une autre image</button>
    </div>
</div>

<div id="champss" style="display: none;" class="form-group col-md-6">
    <label for="">Video</label>
    <input type="file"  class="form-control-file" name="titr[]" id="">
    <div>
        <button type="button" class="btn btn-secondary" id="niveaux">Ajouter une autre video</button>
    </div>
</div> <br> <br>
    <div>
        <button type="submit" style="margin-left: 13%;" class="btn btn-primary" id="">Suivant</button>
    </div>

</form>

<div id="cadrez" class="modal fade">
<form action="{{route('addSponsor')}}" style="width:55%" method="get">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div>
        <h5 class="modal-title">Nom du sponsor</h5>
        </div>
        <button type="button" class="close" id="closez" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-body">
        <div><input name="nom" type="text"></div>
        <button class="btn btn-success" type="submit" style="margin-left: 154px;">Ajouter</button>
      </div>
    </div>
  </div>
  </form>
</div>

<script>
        var ajouter = document.querySelector('#ajouter');
        var niv = document.querySelector('#niv');
        var yes =document.querySelector('#yes');
        yes.addEventListener('click',
        function t(e) {
            document.getElementById("champs").style.display = "block";
        });
        ajouter.addEventListener('click',
        function t(e) {
            document.getElementById("cadrez").classList.add("show");
            document.getElementById("cadrez").style.display = "block";
            modalBackdrop.classList.add("modal-backdrop", "fade", "show");
            document.body.appendChild(modalBackdrop);
        });
        var yess =document.querySelector('#yess');
        yess.addEventListener('click',
        function t(e) {
            document.getElementById("champss").style.display = "block";
        });

        var closeBtn = document.querySelector('#closez');

        // Ajouter un événement de clic à l'icône de fermeture
        closeBtn.addEventListener('click', function() {
            document.getElementById("cadrez").style.display = "none";
            modalBackdrop.classList.remove("modal-backdrop", "fade", "show");
        }) ;

        niv.addEventListener('click',
        function t(e) {
            var champx = document.getElementById("champx");
            var champ = document.createElement("div");
            champ.classList.add("champ");
            champ.innerHTML = `
            <select name="nom[]" class="form-control">
                @foreach ($sponsors as $sponsor)
                    <option value="{{ $sponsor->id }}">{{ $sponsor->nom }}</option>
                @endforeach
            </select>
            `;
            champx.appendChild(champ);
        });

        var niveau = document.querySelector('#niveau');
        var niveaux = document.querySelector('#niveaux');

        niveau.addEventListener('click',
        function t(e) {
            var champs = document.getElementById("champs");
            var champ = document.createElement("div");
            champ.classList.add("champ");
            champ.innerHTML = `
            <input type="file" class="form-control-file" name="titre[]" id="">
            `;
            champs.appendChild(champ);
        });
        niveaux.addEventListener('click',
        function t(e) {
            var champss = document.getElementById("champss");
            var champ = document.createElement("div");
            champ.classList.add("champ");
            champ.innerHTML = `
            <input type="file"  class="form-control-file" name="titr[]" id="">
            `;
            champss.appendChild(champ);
        });

</script>
@endsection
