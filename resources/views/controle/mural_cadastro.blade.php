@extends('layouts.fundo_padrao')

@section('links')
    <div class="links">
        <a href="{{ url('/pag_user') }}">Usuários</a>
        <a href="{{ url('/empresa') }}">Empresa</a>
        <a href="{{ url('/atividades') }}" style="color: rgb(38, 109, 82);">Controle</a>
        <a class="log" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" onmouseover="getElementById('descricao').style.display='block'" onmouseout="getElementById('descricao').style.display='none'"><i class="fas fa-sign-out-alt"></i></a>
        <form id="logout-form" action="{{ url('/ponto_confirma') }}" method="POST" style="display: none;">
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

@section('titulo')
    <h1>Cadastro de Avisos</h1>
@endsection

@section('direita')
<div class="direita cad_user">
        <br>
        <div class="header">
            <a href="{{ url()->previous() }}" class="volt"><p>&#8592;  Voltar</p></a>   
        </div>


        <script>
            // função para mostrar os usuários---------------------------------------------------------
            function mostra_texto()
            {
                var texto = document.getElementById("div-texto");
                var imagem = document.getElementById("div-imagem");
                var video = document.getElementById("div-video");

                texto.classList.remove('mostra');
                imagem.classList.add('mostra');
                video.classList.add('mostra');
            }
            function mostra_imagem()
            {
                var texto = document.getElementById("div-texto");
                var imagem = document.getElementById("div-imagem");
                var video = document.getElementById("div-video");

                texto.classList.add('mostra');
                imagem.classList.remove('mostra');
                video.classList.add('mostra');
            }
            // função para mostrar as equipes---------------------------------------------------------
            function mostra_video()
            {
                var texto = document.getElementById("div-texto");
                var imagem = document.getElementById("div-imagem");
                var video = document.getElementById("div-video");

                texto.classList.add('mostra');
                imagem.classList.add('mostra');
                video.classList.remove('mostra');
            }
        </script> 


        <style>

            .mostra
            {
                display: none;
            }

        </style> 


        <form action="{{ url('/mural/criar')}}" method="POST" enctype="multipart/form-data" class="form-cad">
            {!! csrf_field() !!}
            <div id="form">
                <div class="form-group">
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título do Aviso" required>
                    <br>
                    <textarea name="descricao" placeholder="Descrição do aviso" class="form-control"></textarea>
                </div>
                <br>
                <label>Escolha a forma do aviso:</label>
                <div class="form-group">

                    <!--<input type="radio" name="tipo_destinatario" id="texto" value="1" onfocus="mostra_texto()" >
                    <label for="texto">Texto</label>-->

                    <input type="radio" name="tipo_destinatario" id="imagem" value="2" onfocus="mostra_imagem()" checked>
                    <label for="imagem">Imagem</label>

                    <input type="radio" name="tipo_destinatario" id="video" value="3" onfocus="mostra_video()">
                    <label for="video">Vídeo</label>

                </div>

                <div class="form-group" id="div-texto">
                    <!--<textarea name="descricao" placeholder="Descrição do aviso" class="form-control"></textarea>-->
                </div>

                <div class="form-group" id="div-imagem">
                    <br>
                    <input type="file" name="imagem" id="imagem"> 
                </div>

                <div class="form-group mostra" id="div-video">
                    <input type="text" class="form-control" id="video" name="video" placeholder="Insira o link do vídeo">
                    <br>
                    <input type="number" class="form-control" id="duracao" name="duracao" placeholder="Duração em minutos">
                </div>
    
                <div id="botao">
                    <input type="submit" name="finalizacao" value="Confirmar" class="btn-cad" />
                </div>
            </div>
        </form>

    </div>
@endsection