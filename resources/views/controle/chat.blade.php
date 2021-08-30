@extends('layouts.fundo_padrao')

@section('links')
    <div class="links">
        <a href="{{ url('/pag_user') }}">Usuários</a>
        <a href="{{ url('/empresa') }}">Empresa</a>
        <a href="{{ url('/atividades') }}" style="color: rgb(38, 109, 82);">Controle</a>
        <a class="log" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" onmouseover="getElementById('descricao').style.display='block'" onmouseout="getElementById('descricao').style.display='none'"><i class="fas fa-sign-out-alt"></i></a>
        <form id="logout-form" action="{{ url('/ponto_confirma') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <!--<div id="descricao" name="descricao">Sair</div>-->
    </div>
@endsection

@section('opcoes')
    <div class="opcoes users">
        <div class="a"><a href="{{ url('/mural') }}"><i class="fas fa-calendar-alt"></i></a></div>
        <div class="a"><a href="{{ url('/atividades') }}"><i class="fas fa-list-ul"></i></a></div>
        <div class="a"><a href="{{ url('/chat') }}"><i class="fas fa-comments es"></i></a></div>
    </div>
@endsection

@section('direita')
    <div class="direita">
        <chat></chat>

        <script src="{{ mix('js/app.js') }}"></script>
    </div>
@endsection