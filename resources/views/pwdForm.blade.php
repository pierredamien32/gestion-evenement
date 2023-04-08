<!-- Formulaire de mot de passe oublié -->
@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')
@section('body')
<form style="width: 80%;" method="GET" action="{{route('sendCode')}}">
    @csrf
    <div style="margin-left: 13%;">
    <div class="form-group col-md-6 ">
        <label for="email">Veuillez entrer votre adresse e-mail</label>

        <div>
            <input id="email" type="email" name="email"  required >
        </div>
    </div>

    <div >
        <div>
            <button class="btn btn-primary" type="submit">
                Continuer
            </button>
        </div>
    </div>
</div>
</form>
@endsection


