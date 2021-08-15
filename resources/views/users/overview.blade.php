@extends('layouts.fundo_padrao')

@section('links')
    <div class="links">
        <a href="{{ url('/pag_user') }}" style="color: rgb(38, 109, 82);">Usuários</a>
        <a href="{{ url('/empresa') }}">Empresa</a>
        <a href="{{ url('/atividades') }}">Controle</a>
        <a class="log" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" onmouseover="getElementById('descricao').style.display='block'" onmouseout="getElementById('descricao').style.display='none'"><i class="fas fa-sign-out-alt"></i></a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
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
    </div>
@endsection

@section('direita')
    <div class="direita overview">
        <h1>Overview das atividades</h1>

        <div class="container">
            <div class="lin">
                <div class="posi">1</div>
                <div class="nome">Dayna Caroline Domiciano do Prado</div>
                <div class="ativ">
                    <div class="title">Atividades realizadas</div>
                    <div class="mod">
                        <div class="dificil">
                            <span class="span" style="background-color: rgb(228, 74, 74);">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            6
                        </div>
                        <div class="medio">
                            <span class="span" style="background-color: rgb(250, 250, 100);">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            5
                        </div>
                        <div class="facil">
                            <span class="span" style="background-color: rgb(83, 194, 83);">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            2
                        </div>
                    </div>
                </div>
            </div>

            <div class="lin">
                <div class="posi">2</div>
                <div class="nome">Gabriel</div>
                <div class="ativ">
                    <div class="title">Atividades realizadas</div>
                    <div class="mod">
                        <div class="dificil">
                            <span class="span" style="background-color: rgb(228, 74, 74);">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            5
                        </div>
                        <div class="medio">
                            <span class="span" style="background-color: rgb(250, 250, 100);">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            4
                        </div>
                        <div class="facil">
                            <span class="span" style="background-color: rgb(83, 194, 83);">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            2
                        </div>
                    </div>
                </div>
            </div>

            <div class="lin">
                <div class="posi">3</div>
                <div class="nome">Isabela</div>
                <div class="ativ">
                    <div class="title">Atividades realizadas</div>
                    <div class="mod">
                        <div class="dificil">
                            <span class="span" style="background-color: rgb(228, 74, 74);">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            4
                        </div>
                        <div class="medio">
                            <span class="span" style="background-color: rgb(250, 250, 100);">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            1
                        </div>
                        <div class="facil">
                            <span class="span" style="background-color: rgb(83, 194, 83);">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            2
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection