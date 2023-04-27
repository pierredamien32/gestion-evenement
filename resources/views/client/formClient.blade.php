@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')

@section('body')
<?php //dd(auth()->user()['role_id'])?>
<div class="d-flex justify-content-center align-items-center text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card-body">
                    <div class="w-314 h-44 ms-5 mt-5 fw-bold fs-3 lh-44 text-dark mb-5" style="font-style: normal;font-weight: 700;font-size: 25px;line-height: 30px;color: #000000;">Créer un compte</div>
                    <form  method="GET" action="{{ route('addClient') }}">
                      @csrf
                      <input name="role_id" type="hidden" value="5">
                        <div class="row mb-4" id="nom">
                            <div class="col-md-3 text-md-end"></div>
                            <div class="col-md-6">
                                <input  type="text" class="form-control " name="nom"  required autocomplete="nom" autofocus placeholder="Votre nom">
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
                                <input  type="text" class="form-control " name="telephone"  required autocomplete="telephone" autofocus placeholder="Telephone portable">
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
@endsection
