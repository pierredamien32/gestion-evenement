@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')
@section('body')
<div class="d-flex justify-content-center align-items-center text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card-body">
                    <div class="w-314 h-44 ms-5 mt-5 fw-bold fs-3 lh-44 text-dark mb-5" style="font-style: normal;font-weight: 700;font-size: 25px;line-height: 30px;color: #000000;">Connexion</div>
                    
                    <form  method="POST" action="{{route('login')}}">
                      @csrf
                        
                        <div class="row mb-4">
                            <div class="col-md-3 text-md-end" style="font-style: normal;font-weight: 700;font-size: 16px;line-height: 19px;color: #777777;">Adresse-Email</div>
                            <div class="col-md-6">
                                <input id="email"  type="email" class="form-control " name="email"  required autocomplete="email" autofocus placeholder="Adresse-Email">
                            </div>
                        </div>
                       
                        <div class="row mb-4">
                            <div class="col-md-3 text-md-end" style="font-style: normal;font-weight: 700;font-size: 16px;line-height: 19px;color: #777777;">Mot de passe</div>
                            <div class="col-md-6">
                                <input id="password"  type="password" class="form-control " name="password"  required autocomplete="password" autofocus placeholder="Password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-5">Se connecter</button>
                        <div style="position: relative; top: 20px;">
                            <a href="{{route('pwdForm')}}">Mot de passe oublie?</a>
                        </div> 
                    </form>
                </div>
             </div>
        </div>
    </div>
</div>
@endsection
