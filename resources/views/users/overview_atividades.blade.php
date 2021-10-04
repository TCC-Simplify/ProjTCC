@extends('layouts.fundo_padrao')

@section('links')
    <div class="links">
        <a href="{{ url('/pag_user') }}" style="color: rgb(38, 109, 82);">Usuários</a>
        <a href="{{ url('/empresa') }}">Empresa</a>
        <a href="{{ url('/atividades') }}">Controle</a>
        <a class="log" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" onmouseover="getElementById('descricao').style.display='block'" onmouseout="getElementById('descricao').style.display='none'"><i class="fas fa-sign-out-alt"></i></a>
        <form id="logout-form" action="{{ url('/ponto_confirma') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
       <!--<div id="descricao" name="descricao">Sair</div>-->
    </div>
@endsection

@section('opcoes')
    <div class="opcoes users">
        <div class="a"><a href="{{ url('/pag_user') }}"><i class="fas fa-user"></i></a></div>
        <div class="a" <?php if(Auth::user()->permissao == 3) echo 'style="display: none;"'?>><a href="{{ url('/cadastro_user') }}"><i class="fas fa-user-plus"></i></a></div>
        <div class="a" <?php if(Auth::user()->permissao == 3) echo 'style="display: none;"'?>><a href="{{ url('/users') }}"><i class="fas fa-users"></i></a></div>
        <div class="a"><a href="{{ url('/overview') }}"><i class="fas fa-chart-area es"></i></a></div>
        <div class="a"><a href="{{ url('/dados_ponto') }}"><i class="fas fa-user-clock"></i></a></div>
    </div>
@endsection

@section('titulo')
    <h1>Overview das atividades</h1>
@endsection

@section('direita') 
    <div class="direita overview">
        <div class="header">
            <a href="{{ url()->previous() }}" class="volt"><p>&#8592;  Voltar</p></a>   
        </div>

        <h3>Individuais</h3>
        <br>
        @foreach($atividade_user as $linha)
        <div class="card-o">
            <div class="nome">{{ $linha->atividade }}</div>
            <div style="margin-left: 10px;">Responsável: {{ $nome }}</div>
            <div style="margin-left: 10px;">Descrição: {{ $linha->descricao }}</div>
            <div style="margin-left: 10px;">Prazo: {{ $linha->prazo }}</div>
        </div>
        @endforeach
        </br><br><h3>Em equipe</h3>
        <br>
        @foreach($atividade_equipe as $linha)
            <div class="card-o">
                <div class="nome">{{ $linha->atividade }}</div>
                <div style="margin-left: 10px;">Responsável: {{ $nome_equipe }}</div>
                <div style="margin-left: 10px;">Descrição: {{ $linha->descricao }}</div>
                <div style="margin-left: 10px;">Prazo: {{ $linha->prazo }}</div>
            </div>
        @endforeach
@endsection

<!-- <div class="ativ">
                        <div class="title">Dificuldade</div>
                        <div class="mod">
                            @if ($linha->dificuldade == 3)
                            <div class="dificil">
                                <span class="span" style="background-color: rgb(228, 74, 74);">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                            @elseif ($linha->dificuldade == 2)
                            <div class="medio">
                                <span class="span" style="background-color: rgb(250, 250, 100);">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                            @elseif ($linha->dificuldade == 1)
                            <div class="facil">
                                <span class="span" style="background-color: rgb(83, 194, 83);">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                            @endif
                        </div>
                    </div> -->