<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">

        <title>Admin</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <!-- Styles -->

    </head>
    <body >
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img src="{{ asset('images/logo.png') }}" style="width: 99px; height:55px;" alt="">
    <a class="navbar-brand" href="#">MyEvents</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('index')}}">Acceuil</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{route('allEvents')}}">Evenements</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="GET" action="{{route('adminLoginForm')}}">
           @csrf
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        @if(Session::has('user_name'))
        <select style="margin-right:13px" class="btn btn-outline-primary w-20 my-3 my-sm-0" onchange="window.location.href=this.value">
            <option value="">{{ Session::get('user_name') }}</option>
            <option value="{{route('formEntrepriseAdmin')}}">Creer Entreprise</option>
            @if(auth()->user()['role_id']==1)
            <option value="{{route('adminForm')}}"> Creer Administrateur </option>
            @endif
            <option value="{{route('adminNotification')}}">Notifications</option>
            <option value="{{route('formEvent')}}">Creer un evenement</option>
            <option value="{{ route('myEvents', auth()->user()['id']) }}">Mes evenements</option>
        </select>
        @endif
        </form>
        <form class="form-inline my-lg-1" method="POST" action="{{route('adminLogout')}}">
           @csrf
        <button class="btn btn-outline-danger w-20 my-3 my-sm-0" style="margin-right:13px;" type="submit"> Log out</button>
        </form>
    </div>
</nav>
    @yield('body')

</body>
</html>
