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

@section('titulo')
    <h1>Página de atividades</h1>
@endsection

@section('direita')
    <div class="direita m-users">
        @if ($id == null)
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

            @if(!$tem_ind && !$tem_eq)
                <br><br><br><br>
                <div class="graficos" style="margin: auto; margin-bottom: 50px; color: #8FBC8F;">
                    <h5>Você não tem atividades atribuídas.</h5>
                </div>
            @endif

            @if($tem_ind)
                {{-- ======================== ATIVIDADES INDIVIDUAIS ======================== --}}
                <h3>Individuais</h3>
                <br>
                <div class="cards">
                    @foreach ($ativ as $atividade)
                            @if ( $atividade->tipo_destinatario == 1 && $atividade->destinatario == $id_user && $atividade->finalizacao == "Confirmar")
                                <div class="wrapper">
                                    <div class="card">
                                        <div class="front" <?php if($atividade->dificuldade == 1) echo 'style="background-image: linear-gradient(180deg, rgb(182, 229, 194) 0%, rgba(92,91,94,0) 100%);"';
                                                    else if($atividade->dificuldade == 3) echo 'style="background-image: linear-gradient(180deg, rgb(216, 165, 165) 0%, rgba(92,91,94,0) 100%);"';
                                                    else echo 'style="background-image: linear-gradient(180deg, rgb(229, 224, 182) 0%, rgba(92,91,94,0) 100%);"';?>>
                                            <h1>{{$atividade->atividade}}</h1>
                                            <p><span><?php echo str_replace('-', '/', date( 'd-m-Y' , strtotime( $atividade->prazo ) ));?></span></p>
                                        </div>
                                        <div class="right" <?php if($atividade->dificuldade == 1) echo 'style="background-image: linear-gradient(0deg, rgb(182, 229, 194)  0%, rgba(92,91,94,0) 100%);"';
                                                    else if($atividade->dificuldade == 3) echo 'style="background-image: linear-gradient(0deg, rgb(216, 165, 165)  0%, rgba(92,91,94,0) 100%);"';
                                                    else echo 'style="background-image: linear-gradient(0deg, rgb(229, 224, 182)  0%, rgba(92,91,94,0) 100%);"';?>>
                                            <h2>{{$atividade->atividade}}</h2>
                                            <ul>
                                                <li><?php echo str_replace('-', '/', date( 'd-m-Y' , strtotime( $atividade->prazo ) ));?></li>
                                                <li>Descrição: {{$atividade->descricao}}</li>
                                            </ul>
                                            <a href="{{ url('/atividades/marcar_concluido', $atividade->id) }}"><button>Concluir</button></a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                    @endforeach
                </div> 
            @endif
            <br>

            @if($tem_eq)
                {{-- ======================== ATIVIDADES EM GRUPO ======================== --}}
                <h3>Em grupo</h3>
                <br>
                <div class="cards">
                    @foreach ($ativ as $atividade)
                        @if ( $atividade->tipo_destinatario == 2 && $atividade->destinatario == Auth::user()->equipe && $atividade->finalizacao == "Confirmar")
                            <div class="wrapper">
                                <div class="card">
                                    <div class="front" <?php if($atividade->dificuldade == 1) echo 'style="background-image: linear-gradient(180deg, rgb(182, 229, 194) 0%, rgba(92,91,94,0) 100%);"';
                                                else if($atividade->dificuldade == 3) echo 'style="background-image: linear-gradient(180deg, rgb(216, 165, 165) 0%, rgba(92,91,94,0) 100%);"';
                                                else echo 'style="background-image: linear-gradient(180deg, rgb(229, 224, 182) 0%, rgba(92,91,94,0) 100%);"';?>>
                                        <h1>{{$atividade->atividade}}</h1>
                                        <p><span><?php echo str_replace('-', '/', date( 'd-m-Y' , strtotime( $atividade->prazo ) ));?></span></p>
                                    </div>
                                    <div class="right" <?php if($atividade->dificuldade == 1) echo 'style="background-image: linear-gradient(0deg, rgb(182, 229, 194)  0%, rgba(92,91,94,0) 100%);"';
                                                else if($atividade->dificuldade == 3) echo 'style="background-image: linear-gradient(0deg, rgb(216, 165, 165)  0%, rgba(92,91,94,0) 100%);"';
                                                else echo 'style="background-image: linear-gradient(0deg, rgb(229, 224, 182)  0%, rgba(92,91,94,0) 100%);"';?>>
                                        <h2>{{$atividade->atividade}}</h2>
                                        <ul>
                                            <li><?php echo str_replace('-', '/', date( 'd-m-Y' , strtotime( $atividade->prazo ) ));?></li>
                                            <li>Descrição: {{$atividade->descricao}}</li>
                                            <li>Equipe: 
                                            @foreach ($equipes as $equipe)
                                                @if ($equipe->id == $atividade->destinatario)
                                                    {{$equipe->equipe}}
                                                @endif
                                            @endforeach
                                            </li>
                                        </ul>
                                        <a href="{{ url('/atividades/marcar_concluido', $atividade->id) }}"><button>Concluir</button></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
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

        <script>
            function formatDate (date) {
                return moment(date).format("DD/MM/YYYY HH:mm");
            }
        </script>
    </div>
@endsection