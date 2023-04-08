@extends(auth()->check() && (auth()->user()['role_id']==1 || auth()->user()['role_id']==3) ? 'admin/superPage' : 'welcome')

@section('body')
<div class="container">
    <div class="row justify-content-center">
        <form style="width: 80%;" method="GET" action="{{route('sendResetLink')}}">
    @csrf
    <div style="margin-left: 13%;">
    <div class="form-group col-md-6 ">
        <label for="">Saissisez le code</label>
        <div>
            <input id="" type="" name="code"  required >
        </div>
    <div>
        <div>
            <button class="btn btn-primary" type="submit">
                Valider
            </button>
        </div>
    </div>
</div>
</form>

    </div>

</div>

@endsection
