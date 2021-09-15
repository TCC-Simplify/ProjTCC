@extends('layouts.fundo_padrao')

@section('links')
    <div class="links">
        <a href="{{ url('/pag_user') }}">Usuários</a>
        <a href="{{ url('/empresa') }}">Empresa</a>
        <a href="{{ url('/atividades') }}" style="color: rgb(38, 109, 82);">Controle</a>
        <a class="log" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" onmouseover="getElementById('descricao').style.display='block'" onmouseout="getElementById('descricao').style.display='none'"><i class="fas fa-sign-out-alt"></i></a>
        <form id="logout-form" action="{{ url('/ponto_confirma') }}" method="POST" style="display: none;"> {{-- ap inves de url, poderia ser usado route('mural') --}}
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
        <div class="a"><a href="{{ url('/justificativa') }}"><i class="fas fa-info"></i></a></div>
    </div>
@endsection

@section('direita')
    <div class="direita m-users">
        @if ($id == null)
            <h1>Página de atividades</h1>
            <div class="header">
                <a href="{{ url('/atividades/criar_form') }}" class="ir"><p>Nova atividade &#8594;</p></a>   
            </div>
            @if(Auth::user()->permissao == 2 || Auth::user()->permissao == 1)
                <div class="hed">
                    <a href="/atividades" class="m" style="color: green; font-weight: bold;"><p>Minhas</p></a>
                    <a href="/atividades/funcs" class="f"><p>Meus funcionários</p></a>
                </div>
                <br>
            @endif

            {{-- ======================== ATIVIDADES INDIVIDUAIS ======================== --}}
            <h3>Individuais</h3>
            <div class="cards">
                @foreach ($ativ as $atividade)
                        @if ( $atividade->tipo_destinatario == 1 && $atividade->destinatario == $id_user && $atividade->finalizacao == "Confirmar")
                                <div class="card">
                                    <a href="atividades{{$atividade->id}}">
                                        {{$id;}}
                                        <br>
                                        <div class="nome">
                                            <h4>{{$atividade->atividade}}</h4>
                                            <span <?php
                                                if($atividade->dificuldade == 1) echo 'style="background-color: rgb(83, 194, 83);"';
                                                else if($atividade->dificuldade == 3) echo 'style="background-color: rgb(228, 74, 74);"';
                                                else echo 'style="background-color: rgb(250, 250, 100);"';
                                            ?>></span>
                                        </div>
                                        <br>
                                        <p>Descrição: {{$atividade->descricao}}</p>
                                        <p>Data de entrega: {{$atividade->prazo}}</p>
                                        <br>
                                    </a>
                                </div>
                        @endif
                @endforeach
            </div>
            {{-- ======================== ATIVIDADES EM GRUPO ======================== --}}
            <br>
            <h3>Em grupo</h3>
            <div class="cards">
                @foreach ($ativ as $atividade)
                    @if ( $atividade->tipo_destinatario == 2 && $atividade->destinatario == $id_user && $atividade->finalizacao == "Confirmar")
                        <div class="card">
                            <a href="atividades{{$atividade->id}}">
                                {{$id;}}
                                <br>
                                <div class="nome">
                                    <h4>{{$atividade->atividade}}</h4>
                                    <span <?php
                                        if($atividade->dificuldade == 1) echo 'style="background-color: rgb(83, 194, 83);"';
                                        else if($atividade->dificuldade == 3) echo 'style="background-color: rgb(228, 74, 74);"';
                                        else echo 'style="background-color: rgb(250, 250, 100);"';
                                    ?>></span>
                                </div>
                                <br>
                                <p>Equipe:
                                    @foreach ($equipes as $equipe)
                                        @if ($equipe->id == $atividade->destinatario)
                                            {{$equipe->equipe}}
                                        @endif
                                    @endforeach
                                </p>
                                <p>Descrição: {{$atividade->descricao}}</p>
                                <p>Data de entrega: {{$atividade->prazo}}</p>
                                <br>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>

        @else
            {{-- ======================== DETALHES DA ATIVIDADE ======================== --}}
            @foreach ($ativ as $atividade)
                @if ($id == $atividade->id)
                    <div class="header">
                        <a href="{{ url('/atividades') }}" class="ir"><p>Voltar</p></a>   
                    </div>
                    <h1>Detalhes da Atividade</h1>

                    <div class="detalhes">
                        <center><h3>{{$atividade->atividade}}</h3></center>
                        <br>
                        <p><strong>Destinatário:</strong> 
                            @if ( $atividade->tipo_destinatario == 1)
                                @foreach ($users as $user)
                                    @if ($user->id == $atividade->destinatario)
                                        {{$user->name}}
                                    @endif
                                @endforeach

                            @else
                                @foreach ($equipes as $equipe)
                                @if ($equipe->id == $atividade->destinatario)
                                    {{$equipe->equipe}}
                                @endif
                                @endforeach

                            @endif
                        </p>
                        <p><strong>Descrição:</strong>  {{$atividade->descricao}}</p>
                        <p><strong>Data de entrega:</strong>  {{$atividade->prazo}}</p>
                        <p><strong>Finalização:</strong> 
                            <?php
                                if($atividade->dificuldade == 1) echo 'Fácil';
                                else if($atividade->dificuldade == 2) echo 'Médio';
                                else echo 'Difícil';
                            ?>
                        </p>
                        <p><strong>Estado:</strong> 
                            <?php
                                if($atividade->finalizacao == 'Confirmar') echo 'Em andamento';
                                else echo 'Finalizada';
                            ?>
                        </p>
                        <br>
                        <div class="final">
                            <center><a href="{{ url('/atividades/marcar_concluido', $atividade->id) }}"><button class="btn-fim">Finalizar atividade</button></a></center>
                        </div>
                    </div> 
                @endif
            @endforeach
        @endif
    </div>
@endsection