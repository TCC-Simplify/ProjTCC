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
        <div class="a"><a href="{{ url('/overview') }}"><i class="fas fa-chart-area"></i></a></div>
        <div class="a"><a href="{{ url('/dados_ponto') }}"><i class="fas fa-user-clock es"></i></a></div>
    </div>
@endsection

@section('direita')
    <div class="direita cad_user">
        <h1>Dados do Ponto</h1>
        <br><br>
        <h3>Último ponto registrado: {{$ponto->created_at}}</h3>
        <h3>{{$status}}</h3>
        <br>
        <div id="botao">
            <form action="{{ url('/saida_ponto') }}" method="POST" enctype="multipart/form-data" class="form-cad">
            {!! csrf_field() !!}
            @if ($status == 'Entrada')
                <input type="submit" name="botao" value="Encerrar Ponto" style="padding-left:25px;padding-right:25px;margin-right:60px;background-color:rgb(38, 109, 82);color:white;"/>
            @endif
                <a href="{{ url('/historico_ponto') }}"><input type="button" name="botao" value="Histórico de Pontos" style="background-color:rgb(38, 109, 82);color:white;"/></a>
            </form>   
        </div>
    </div>
@endsection 