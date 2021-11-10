@extends('layouts.fundo_padrao')

@section('links')
    <div class="links">
        <a href="{{ url('/pag_user') }}">Usuários</a>
        <a href="{{ url('/empresa') }}" style="color: rgb(38, 109, 82);">Empresa</a>
        <a href="{{ url('/atividades') }}">Controle</a>
        <a class="log" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" onmouseover="getElementById('descricao').style.display='block'" onmouseout="getElementById('descricao').style.display='none'"><i class="fas fa-sign-out-alt"></i></a>
        <form id="logout-form" action="{{ url('/ponto_confirma') }}" method="POST" style="display: none;">
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

@section('titulo')
    <h1>Adicionar Usuário</h1>
@endsection

@section('direita')
    <form action="{{ url('/equipe/add', $nome) }}" method="GET">
        <br>
        <div class="filter" style="margin-bottom: -30px;"> 
            <input type="text" class="buscar" autocomplete="off" name="user_filtro" placeholder="Pesquise um usuário"></input>
            <button type="submit" class="butbuscar"><i class="fa fa-search"></i></button>
        </div>
    </form>
    <div class="direita cad_user">
        <form action="{{ url('/equipe/add/processing', $nome)}}" method="POST" enctype="multipart/form-data" class="form-cad">
        {!! csrf_field() !!}
            <div class="form-group" style="text-align: left;">
                @foreach ($usuarios as $usuario)
                    @if(str_contains(strtolower($usuario->name), $filtro))
                        <input type="checkbox" name="users[]" value="{{ $usuario->id }}">&nbsp;&nbsp;{{ $usuario->name }} <br>
                    @endif
                @endforeach
            </div>
            <div id="botao">
                <input type="submit" name="botao" value="Confirmar" class="btn-cad" />
            </div>
        </form>
    </div>

    <style>
        .filter{
            float: center;
            margin-top: 20px;
        }

        .filter-button{
            margin-left: 0px;
            width: 30px;
        }
    </style>
@endsection
