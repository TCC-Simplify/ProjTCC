@extends('layouts.fundo_padrao')

@section('links')
    <div class="links">
        <a href="{{ url('/pag_user') }}">Usuários</a>
        <a href="{{ url('/empresa') }}" style="color: rgb(38, 109, 82);">Empresa</a>
        <a href="{{ url('/mural') }}">Controle</a>
        <a class="log" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" onmouseover="getElementById('descricao').style.display='block'" onmouseout="getElementById('descricao').style.display='none'"><i class="fas fa-sign-out-alt"></i></a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <!--<div id="descricao" name="descricao">Sair</div>-->
    </div>
@endsection

@section('opcoes')
    <div class="opcoes empresa">
        <div class="a"><a href="{{ url('/empresa') }}"><i class="fas fa-city"></i></a></div>
        <div class="a"><a href="{{ url('/equipes') }}" <?php if(Auth::user()->permissao == 3) echo 'style="display: none;"'?>><i class="fas fa-users es"></i></a></div>
    </div>
@endsection

@section('direita')
    <div class="direita cad_user">
        <h1>Adicionar Usuário</h1>
        <form action="{{ url('/equipe/add/processing', $nome)}}" method="POST" enctype="multipart/form-data" class="form-cad">
        {!! csrf_field() !!}
            <div class="form-group" style="text-align: left;">
                @foreach ($usuarios as $usuario)
                    <input type="checkbox" name="users[]" value="{{ $usuario->id }}">&nbsp;&nbsp;{{ $usuario->name }} <br>
                @endforeach
            </div>
            <div id="botao">
                <input type="submit" name="botao" value="Confirmar" class="btn-cad" />
            </div>
        </form>
    </div>
@endsection
