@extends('admin/superPage')

@section('body')
<?php //dd(auth()->user()['role_id'])?>
<form style="width: 80%;" method="GET" action="{{ route('adminRegister') }}">
@csrf
<div style="margin-left: 13%;">
    <input name="role_id" type="hidden" value="3">
<div class="form-row">
    <div class="form-group col-md-6"id="nom">
      <label for="nom">Nom</label>
      <input type="text" class="form-control" name="nom" placeholder="MERCEDES">
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
      <label for="sociale">Telephone </label>
      <input type="text" class="form-control" name="telephone" placeholder="666696999">
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
<button type="submit" class="btn btn-primary">Sign in</button>
</div>
</form>
@endsection
