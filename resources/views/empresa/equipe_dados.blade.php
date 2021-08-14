@extends('layouts.fundo_padrao')

@section('links')
    <div class="links">
        <a href="{{ url('/pag_user') }}">Usuários</a>
        <a href="{{ url('/empresa') }}" style="color: rgb(38, 109, 82);">Empresa</a>
        <a href="{{ url('/atividades') }}">Controle</a>
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
    <div class="direita m-users">
        <h1>{{ $nome }}</h1>
        </br>
        <h3>Dados das Atividades</h3>
        </br>
        <p>Aqui estarão dados e estatísticas sobre as atividades atribuídas à equipe.</p>
        <p>Área de atividades ainda está em desenvolvimento.</p>
        </br>
        <div class="header">
            <a href="{{ url('/equipe/add', $nome) }}" class="ir"><p>Add usuário &#8594;</p></a>   
        </div>
        <h1>Lista de Usuários</h1>
        <table class="table table-striped">
            <thead>
                <th>Nome</th>
                <th>Controle</th>
            </thead>

            @foreach($usuarios as $usuario)
                <tbody>
                    <td>{{ $usuario->name }}</td>
                    <td>
                        <form method="post" action="{{ url('/equipe/delete') }}">{!! csrf_field() !!}
                            <input type="hidden" name="usuario" value="{{ $usuario->id }}">
                            <button type="submit" name="submit" class="de" style="border: none; background-color: transparent; cursor: pointer; outline:none;"><i class="fas fa-user-times"></i></button>
                        </form>
                    </td>
                </tbody>
            @endforeach
        </table>
    </div>
@endsection
