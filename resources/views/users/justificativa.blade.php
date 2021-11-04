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
        <div class="a"><a href="{{ url('/atividades') }}"><i class="fas fa-list-ul"></i></a></div>
        <div class="a"><a href="{{ url('/chat') }}"><i class="fas fa-comments"></i></a></div>
        <div class="a"><a href="{{ url('/chat') }}"><i class="fas fa-info es"></i></a></div>
    </div>
@endsection

@section('titulo')
    <h1>Justificativa</h1>
@endsection

@section('direita')
        <div class="direita cad_user">
            <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@vsilva472/jquery-viacep/dist/jquery-viacep.min.js"></script>
            <script src="<?php echo asset('js/jquery.maskedinput-1.1.4.pack.js')?>" type="text/javascript"></script>
            <script src="<?php echo asset('js/funcs_cad_profissional.js')?>"></script> 

            <form action="{{ url('/justificativa')}}" method="POST" enctype="multipart/form-data" class="form-cad">

                <div class="form-group">

                    {{ csrf_field() }}
                    <input type="hidden" name="ponto" value="{{$ponto->id}}">

                    <input type="text" class="form-control cad-tam" name="name" placeholder="Nome:" value=" Ponto: {{$ponto->created_at}}" disabled>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control cad-tam" name="tipo" placeholder="Motivo:" value="{{$justificativas->tipo ?? old('tipo') }}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control cad-tam" name="justificativa" placeholder="Comentário:" value="{{ $justificativas->justificativa ?? old('justificativa') }}">
                </div>

                <div id="botao">
                <input type="submit" name="botao" value="Enviar" class="btn-cad" />
                </div>
            </form>
        </div>



@endsection