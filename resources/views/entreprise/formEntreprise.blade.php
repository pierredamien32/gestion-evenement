@extends('welcome')

@section('body')
<?php //dd(auth()->user()['role_id'])?>
<!--img style="position: absolute;" src="{{ asset('images/fond.png') }}" alt=""-->
<!-- <div class="d-flex justify-content-center align-items-center"> -->
<div class="d-flex justify-content-center align-items-center text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card-body">
                    <div class="w-314 h-44 ms-5 mt-5 fw-bold fs-3 lh-44 text-dark mb-5" style="font-style: normal;font-weight: 700;font-size: 25px;line-height: 30px;color: #000000;">Créer un compte</div>
                    
                    <form method="GET" action="{{ route('addEntreprise') }}" style="width: 100%; background-image:url;">
                      @csrf
                      <div class="row mb-4">
                      <div class="col-md-3 text-md-end" style="font-style: normal;font-weight: 700;font-size: 16px;line-height: 19px;color: #777777; position: relative; left: 30px; top:8px;">Votre status:</div>
                        <div class="form-group col-md-6 ">
                            <!-- <label for="type">Type :</label> -->
                            <select name="role_id" class="form-control" id="role" required>
                                <option value="" >Choissisez votre statut</option>
                                <option value="personne" >Personne</option>
                                <option value="entreprise" >Entreprise</option>
                            </select>
                        </div>
                      </div>
                      
                        <div class="row mb-4" id="nom">
                            <div class="col-md-3 text-md-end"></div>
                            <div class="col-md-6">
                                <input  type="text" class="form-control " name="nom"  required autocomplete="nom" autofocus placeholder="Votre nom">
                            </div>
                        </div>
                        <div class="row mb-4" id="sigle">
                            <div class="col-md-3 text-md-end"></div>
                            <div class="col-md-6">
                                <input  type="text" class="form-control " name="sigle"  required autocomplete="sigle" autofocus placeholder="Sigle">
                            </div>
                        </div>
                        <div class="row mb-4" id="sociale">
                            <div class="col-md-3 text-md-end"></div>
                            <div class="col-md-6">
                                <input  type="text" class="form-control " name="sociale"  required autocomplete="sociale" autofocus placeholder="Denomination Sociale">
                            </div>
                        </div>
                        <div class="row mb-4" id="prenom">
                            <div class="col-md-3 text-md-end"></div>
                            <div class="col-md-6">
                                <input  type="text" class="form-control " name="prenom"  required autocomplete="prenom" autofocus placeholder="Votre prénom">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-3 text-md-end"></div>
                            <div class="col-md-6">
                                <input  type="email" class="form-control " name="email"  required autocomplete="email" autofocus placeholder="Adresse-Email">
                            </div>
                        </div>
                        <div class="row mb-4" >
                            <div class="col-md-3 text-md-end"></div>
                            <div class="col-md-6">
                                <input  type="text" class="form-control " name="adresse"  required autocomplete="adresse" autofocus placeholder="Adresse Ex: Boulevard de la Marina, Lot336">
                            </div>
                        </div>
                        <div class="row mb-4" >
                            <div class="col-md-3 text-md-end"></div>
                            <div class="col-md-6">
                                <input  type="text" class="form-control " name="ifu"  required autocomplete="ifu" autofocus placeholder="Ifu Ex: AZ15896OP589">
                            </div>
                        </div>
                        <div class="row mb-4">
                      <div class="col-md-3 text-md-end" style="font-style: normal;font-weight: 700;font-size: 16px;line-height: 19px;color: #777777; position: relative; left: 30px; top:8px;"> Votre Pays: </div>
                        <div class="form-group col-md-6 ">
                            <!-- <label for="type">Type :</label> -->
                            <select name="pays" class="form-control">
                              <option selected>Benin</option>
                              <option value="Togo">Togo</option>
                            </select>
                        </div>
                      </div>
                        <div class="row mb-4" >
                            <div class="col-md-3 text-md-end"></div>
                            <div class="col-md-6">
                                <input  type="text" class="form-control " name="tel"  required autocomplete="tel" autofocus placeholder="Telephone portable">
                            </div>
                        </div>
                        <div class="row mb-4" >
                            <div class="col-md-3 text-md-end"></div>
                            <div class="col-md-6">
                                <input  type="text" class="form-control " name="fixe"  required autocomplete="fixe" autofocus placeholder="Telephone fixe">
                            </div>
                        </div>
                        <div class="row mb-4" id="description">
                            <div class="col-md-3 text-md-end"></div>
                            <div class="col-md-6">
                                <input  type="text" class="form-control " name="description"  required autocomplete="description" autofocus placeholder="Donnez une description">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-3 text-md-end"></div>
                            <div class="col-md-6">
                                <input  type="password" class="form-control " name="password"  required autocomplete="password" autofocus placeholder="Password">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-3 text-md-end"></div>
                            <div class="col-md-6">
                                <input  type="password" class="form-control " name="password_confirmation"  required autocomplete="password_confirmation" autofocus placeholder="Confirm password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-5">Sign in</button>
                    </form>
                </div>
             </div>
        </div>
    </div>
</div>
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
