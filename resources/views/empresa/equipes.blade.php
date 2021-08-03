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
    <div class="direita m-users">
        <div class="header">
            <a href="{{ url('/form_criar_equipe') }}" class="ir"><p>Nova Equipe &#8594;</p></a>   
        </div>
        <h1>Equipes</h1>
        <table class="table table-striped">
            <thead>
                <th>Nome</th>
                <th>Controle</th>
            </thead>

            @foreach ($equipes as $equipe)
                <tbody>
                    <td>{{ $equipe->equipe }}</td>
                    <td>
                        <form method="post" action="{{ url('/deletar_equipe') }}">{!! csrf_field() !!}
                            <a href="{{ url('/equipe', $equipe->equipe) }}" style="color:white;text-decoration:none;"><i class="fas fa-eye ed"></i></a>&nbsp;&nbsp;
                            <input type="hidden" name="equipe" value="{{ $equipe->id }}">
                            <button type="submit" name="submit" class="de" style="border: none; background-color: transparent; cursor: pointer; outline:none;"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tbody>
            @endforeach
        </table>
    </div>
@endsection
