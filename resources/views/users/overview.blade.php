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

        <div class="container">
        <?php $pos = 1; $red = 0; $yellow = 0; $green = 0; ?>
        @foreach($users as $user)
            @foreach($atividades as $linha)
                @if ($linha->tipo_destinatario == 1 && $linha->destinatario == $user->id)
                    @if ($linha->dificuldade == 1) <?php $green++; ?>
                    @elseif ($linha->dificuldade == 2) <?php $yellow++; ?>
                    @elseif ($linha->dificuldade == 3) <?php $red++; ?>
                    @endif
                @elseif ($linha->tipo_destinatario == 2 && $linha->destinatario == $user->equipe)
                    @if ($linha->dificuldade == 1) <?php $green++; ?>
                    @elseif ($linha->dificuldade == 2) <?php $yellow++; ?>
                    @elseif ($linha->dificuldade == 3) <?php $red++; ?>
                    @endif
                @endif
            @endforeach
                <div class="lin">
                    <div class="posi">{{ $pos }}</div>
                    <div class="nome"><a href="{{ url('/overview', $user->id)}}">{{$user->name}}</a></div>
                    <div class="ativ">
                        <div class="title">Atividades realizadas</div>
                        <div class="mod">
                            <div class="dificil">
                                <span class="span" style="background-color: rgb(228, 74, 74);">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                {{ $red }}
                            </div>
                            <div class="medio">
                                <span class="span" style="background-color: rgb(250, 250, 100);">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                {{ $yellow }}
                            </div>
                            <div class="facil">
                                <span class="span" style="background-color: rgb(83, 194, 83);">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                {{ $green }}
                            </div>
                        </div>
                    </div>
                </div>
                <?php $pos++; $red = 0; $yellow = 0; $green = 0;?>
            @endforeach
        </div>
    </div>
@endsection