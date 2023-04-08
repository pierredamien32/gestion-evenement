@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')
@section('body')
<form style="width: 80%;" method="POST" action="{{route('login')}}">
    @csrf
    <div style="margin-left: 13%;">
    <h3> Connectez vous </h3>
    <div class="form-group col-md-6 ">
        <label for="email">Adresse e-mail</label>

        <div>
            <input id="email" type="email" name="email"  required >
        </div>
    </div>

    <div class="form-group col-md-6 ">
        <label for="password">Mot de passe</label>

        <div>
            <input id="password" type="password" name="password" required>
        </div>
    </div>

    <div >
        <div>
            <button class="btn btn-primary" type="submit">
                Se connecter
            </button>
        </div>
    </div>
    <div>
        <a href="{{route('pwdForm')}}">Mot de passe oublie?</a>
    </div>
</div>
</form>
@endsection
