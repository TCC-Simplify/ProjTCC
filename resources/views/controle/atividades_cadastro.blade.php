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
        <h1>Cadastro de Atividades</h1>
        <br>
        

        <form action="{{ url('/criar_equipe')}}" method="POST" enctype="multipart/form-data" class="form-cad">
            {!! csrf_field() !!}
                <div class="form-group">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Título da Atividade:" required>
                </div>
                <div class="form-group">
                    {{--
                    <select id="usuario" name="usuario" style="height:40px;">
                        <option value="" selected disabled hidden>Selecione um usuário: </option>
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option> 
                        @endforeach
                    </select>
                    --}}
                </div>
                <div id="botao">
                    <input type="submit" name="botao" value="Confirmar" class="btn-cad" />
                </div>
            </form>

    </div>
@endsection