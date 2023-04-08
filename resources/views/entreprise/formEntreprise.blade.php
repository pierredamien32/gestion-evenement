@extends('welcome')

@section('body')
<?php //dd(auth()->user()['role_id'])?>
<!--img style="position: absolute;" src="{{ asset('images/fond.png') }}" alt=""-->
<form style="width: 100%; background-image:url; " method="GET" action="{{ route('addEntreprise') }}">
@csrf
<div style="width: 85%;" >
<div style="margin-left: 13%;">
<div class="form-group col-md-6 ">
    <label for="type">Type :</label>
    <select name="role_id" class="form-control" id="role" required>
        <option value="" >Choissisez votre statut</option>
        <option value="personne" >Personne</option>
        <option value="entreprise" >Entreprise</option>
    </select>
</div>
<div class="form-row">
    <div class="form-group col-md-6"id="nom">
      <label for="nom">Nom</label>
      <input type="text" class="form-control" name="nom" placeholder="MERCEDES">
    </div>
    <div class="form-group col-md-6"id="sigle">
      <label for="nom">Sigle</label>
      <input type="text" class="form-control" name="sigle" placeholder="SAFA">
    </div>
    <div class="form-group col-md-6" id="sociale">
      <label for="sociale">Denomination Sociale</label>
      <input type="text" class="form-control" name="sociale" >
    </div>
    <div class="form-group col-md-6" id="prenom">
      <label for="prenom">Prenom</label>
      <input type="text" class="form-control" name="prenom" placeholder="Safa">
    </div>

    <div class="form-group col-md-6">
      <label for="email">Adresse-Email</label>
      <input type="email" class="form-control" name="email" placeholder="Email">
    </div>
    <div class="form-group col-md-6 ">
      <label for="sociale">Adresse</label>
      <input type="text" class="form-control" name="adresse" placeholder="Boulevard de la Marina, Lot336">
    </div>
    <div class="form-group col-md-6 ">
      <label for="sociale">Numero IFU</label>
      <input type="text" class="form-control" name="ifu" placeholder="AZ15896OP589">
    </div>
    <div class="form-group col-md-6">
      <label for="inputState">Pays</label>
      <select name="pays" class="form-control">
        <option selected>Benin</option>
        <option value="Togo">Togo</option>
      </select>
    </div>
    <div class="form-group col-md-6 ">
      <label for="sociale">Telephone portable</label>
      <input type="text" class="form-control" name="tel" placeholder="666696999">
    </div>
    <div class="form-group col-md-6 ">
      <label for="sociale">Telephone fixe</label>
      <input type="text" class="form-control" name="fixe" placeholder="6699877777">
    </div>
    <div class="form-group col-md-8"id="description">
      <label for="description">Description</label>
      <input type="text" class="form-control" name="description" >
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Confirm Password</label>
      <input type="password" class="form-control" name="password_confirmation" placeholder="Password">
    </div>
</div>
<button type="submit" style="margin-left: 45%;"class="btn btn-primary">Sign in</button>
</div>
</div>
</form>
<script>
    // Récupérer les éléments HTML
    var roleSelect = document.querySelector('#role');
    var nomInput = document.querySelector("#nom");
    var prenomInput = document.querySelector("#prenom");
    var sigleInput = document.querySelector("#sigle");
    var socialeInput = document.querySelector("#sociale");
    var descriptionInput = document.querySelector("#description");
    var submitInput = document.querySelector("input[type='submit']");
    // Fonction de gestionnaire d'événement pour le changement de sélection
    roleSelect.addEventListener(
        "change",
        function t(e) {
        var num = e.target.value;

        if (num === 'entreprise') {
            nomInput.setAttribute("hidden","");
            prenomInput.setAttribute("hidden","");
            sigleInput.removeAttribute("hidden","");
            socialeInput.removeAttribute("hidden","");
            descriptionInput.removeAttribute("hidden","");
        }else if (num === 'personne') {
            nomInput.removeAttribute("hidden","");
            prenomInput.removeAttribute("hidden","");
            socialeInput.setAttribute("hidden","");
            sigleInput.setAttribute("hidden","");
            descriptionInput.setAttribute("hidden","");

        }
    });
    
    
</script>
@endsection
