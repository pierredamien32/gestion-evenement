@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')

@section('body')
<?php //dd(auth()->user()['role_id'])?>

<form style="width: 100%; background-image:url; " method="GET" action="{{ route('createEvent') }}">
@csrf
<div style="margin-left: 13%;">
<div class="">
      <input type="hidden" value="{{ Session::get('id') }}" class="form-control" name="entreprise_id">
      <input type="hidden" value="{{ Session::get('role_id')}}" class="form-control" name="role_id">
    <div class="form-group col-md-6"id="intitule">
      <label for="">Intitule</label>
      <input type="text" class="form-control" name="intitule" placeholder="MERCEDES">
    </div>
    <div class="form-group col-md-6"id="categorie">
        <label for="category_id">Catégorie :</label>
        <select id="category_id" class="form-control" name="category_id" required>
        @foreach ($categories as $categorie)
            <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
        @endforeach
        </select>
        <span>Votre categorie nest pas dans la liste?</span>
        <button id="ajouter" class="btn btn-primary" type="button">+ Ajouter</button>
    </div>
    <div class="form-group col-md-6" id="statut">
        <label for="statut">Statut :</label>
        <select id="statut" name="statut" class="form-control" required>
            <option value="">Sélectionner un statut</option>
            <option value="A venir">A venir</option>
            <option value="En cours">En cours</option>
            <option value="Passe">Passe</option>
        </select>
    </div>
    <div class="form-group col-md-6" id="lieu">
        <label for="lieu">Lieu :</label>
        <input type="text" class="form-control" id="lieu" name="lieu" required>
    </div>

    <div class="form-group col-md-6">
        <label for="dateDeb">Date de début :</label>
        <input type="date"  class="form-control" id="dateDeb" name="dateDebut" required>
    </div>
    <div class="form-group col-md-6 ">
        <label for="dateFin">Date de fin :</label>
        <input type="date" id="dateFin" class="form-control" name="dateFin" >
    </div>
    <div class="form-group col-md-6 ">
        <label for="heure">Heure :</label>
        <input type="time" id="heure" class="form-control" name="heure" required>
    </div>
    <div class="form-group col-md-8"id="description">
        <label for="description">Description :</label>
        <textarea id="description" class="form-control" rows="4" name="description" required></textarea>
    </div>

</div>
<button type="submit" style="margin-left: 45%;"class="btn btn-primary">Suivant</button>
</div>
</div>
</form>

<div id="cadrez" class="modal fade">
<form action="{{route('addCategorie')}}" style="width:55%" method="get">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div>
        <h5 class="modal-title">Nom de la categorie</h5>
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
        })

        var closeBtn = document.querySelector('#closez');

        // Ajouter un événement de clic à l'icône de fermeture
        closeBtn.addEventListener('click', function() {
            document.getElementById("cadrez").style.display = "none";
            modalBackdrop.classList.remove("modal-backdrop", "fade", "show");
        }) ;

</script>
@endsection
