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
        <div class="a" <?php if(Auth::user()->permissao == 3) echo 'style="display: none;"'?>><a href="{{ url('/users') }}"><i class="fas fa-users es"></i></a></div>
        <div class="a"><a href="{{ url('/overview') }}"><i class="fas fa-chart-area"></i></a></div>
        <div class="a"><a href="{{ url('/dados_ponto') }}"><i class="fas fa-user-clock"></i></a></div>
    </div>
@endsection

@section('titulo')
    <h1>Usuários cadastrados</h1>
@endsection

@section('direita')
    <div class="direita m-users">
        <?php
            $aux=0;
            foreach ($todos as $user){
                if($user->ativo == 'n'){
                    $aux=1;
                }
            }
        ?>

        <form action="{{ url('/users') }}" method="GET">
            {!! csrf_field() !!}
            <div class="filter" > 
                <input type="text" class="buscar" name="user_filtro" autocomplete="off" placeholder="Pesquise um usuário"></input>
                <button type="submit" class="butbuscar"><i class="fa fa-search"></i></button>
            </div>
            <br>
        </form>

        <div class="header">
            <a href="{{ url('/users_des') }}" class="ir" <?php if($aux == 0) echo 'style="display: none;"'?>><p>Usuários desativados &#8594;</p></a>   
            <br>
        </div>

        <table class="table table-striped">
            <thead>
                <th>Nome</th>
                <th>Setor</th>
                <th>Cargo</th>
                <th>Controle</th>
            </thead>

            @foreach($todos as $user)
                @if($user->ativo == 's' && $user->id != Auth::user()->id)
                    <tbody>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->funcao }}</td>
                        <td><?php 
                        $aux = $user->permissao;
                        if($aux == 1){
                            echo 'Administrador';
                        }else if($aux == 2){
                                echo 'Gerente';
                        }else{
                                echo 'Funcionário';
                        }
                        ?></td>
                        <td><a href="{{ url('/alt_user', $user->id) }}"><i class="fas fa-user-edit ed"></i></a>&nbsp &nbsp &nbsp<a href="{{ url('/del_user', $user->id) }}"><i class="fas fa-user-times de"></i></a></td>
                    </tbody>
                @endif
            @endforeach
        </table>

        {{ $todos->links() }}
    </div>
@endsection