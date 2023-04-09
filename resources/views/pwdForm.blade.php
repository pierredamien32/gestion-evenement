<!-- Formulaire de mot de passe oublié -->
@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')
@section('body')
<div class="d-flex justify-content-center align-items-center text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card-body">
                    <div class="w-314 h-44 ms-5 mt-5 fw-bold fs-3 lh-44 text-dark mb-5" style="font-style: normal;font-weight: 700;font-size: 25px;line-height: 30px;color: #000000;">Récupérer mon compte</div>
                    
                    <form  method="GET" action="{{route('sendCode')}}">
                      @csrf
                        
                        <div class="row mb-4">
                            <div class="col-md-3 text-md-end" style="font-style: normal;font-weight: 700;font-size: 16px;line-height: 19px;color: #777777;">Veuillez entrer votre adresse e-mail</div>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email"  required autocomplete="email" autofocus placeholder="Adresse-Email">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary px-5">Continuer</button>
                        
                    </form>
                </div>
             </div>
        </div>
    </div>
</div>
@endsection


