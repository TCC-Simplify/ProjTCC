@extends('layouts.fundo_padrao')

@section('links')
    <div class="links">
        <a href="{{ url('/pag_user') }}">Usuários</a>
        <a href="{{ url('/empresa') }}">Empresa</a>
        <a href="{{ url('/mural') }}" style="color: rgb(38, 109, 82);">Controle</a>
        <a class="log" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" onmouseover="getElementById('descricao').style.display='block'" onmouseout="getElementById('descricao').style.display='none'"><i class="fas fa-sign-out-alt"></i></a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <!--<div id="descricao" name="descricao">Sair</div>-->
    </div>
@endsection

@section('opcoes')
    <div class="opcoes users">
        <div class="a"><a href="{{ url('/mural') }}"><i class="fas fa-calendar-alt"></i></a></div>
        <div class="a"><a href="{{ url('/atividades') }}"><i class="fas fa-list-ul es"></i></a></div>
        <div class="a"><a href="{{ url('/chat') }}"><i class="fas fa-comments"></i></a></div>
    </div>
@endsection

@section('direita')
    <div class="direita cad_user">
        <h1>Página de atividades</h1>
        <br>
        <h3>Individual</h3>
        @foreach ($ativ as $atividade)
            <div style="background: rgb(75, 74, 72);
            border-radius: 15px; width: 600px">
                @if ( $atividade->tipo_destinatario == 1)
                <br>
                <h4>{{$atividade->atividade}}</h4>
                <h5>Descrição: {{$atividade->descricao}}</h5>
                <h5>Data de entrega: {{$atividade->prazo}}</h5>
                <br>
                @endif
            
            </div>
        @endforeach
        <br>
        <h3>Grupo</h3>

        @foreach ($ativ as $atividade)
            <div style="background: rgb(75, 74, 72);
                border-radius: 15px; width: 600px">
                
                @if ( $atividade->tipo_destinatario == 2)
                <h4>{{$atividade->atividade}}</h4>
                <h5>Descrição: {{$atividade->descricao}}</h5>
                <h5>Data de entrega: {{$atividade->prazo}}</h5>
                @endif
                
            
            </div>
        @endforeach

        <div style="font-size:18px;font-weight:bolder;"><a href="{{ url('/atividades/criar') }}">Cadastrar nova atividade</a></div>
    </div>
@endsection