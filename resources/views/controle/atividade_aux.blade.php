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
    </div>
@endsection

@section('titulo')
    <h1>Página de atividades</h1>
@endsection

@section('direita')
    <div class="direita cad_user">
        <br>
        {{-- ======================== CASO O USUÁRIO SEJA FUNCIONÁRIO APENAS ======================== --}}
        @if ($id == null && $permissao == 3)
        {{-- ======================== ATIVIDADES INDIVIDUAIS ======================== --}}
            <h3>Individual</h3>
            @foreach ($ativ as $atividade)
        
                    @if ( $atividade->tipo_destinatario == 1 && $atividade->destinatario == $id_user)
                        <a href="atividades{{$atividade->id}}" style=" color:white; text-decoration: none;">

                            <div style="background: rgb(75, 74, 72);
                            border-radius: 15px; width: 600px">
                                {{$id;}}
                                <br>
                                <h4>{{$atividade->atividade}}</h4>
                                <h5>Destinatário: 
                                    @foreach ($users as $user)
                                        @if ($user->id == $atividade->destinatario)
                                            {{$user->name}}
                                        @endif
                                    @endforeach
                                </h5>
                                <h5>Descrição: {{$atividade->descricao}}</h5>
                                <h5>Data de entrega: {{$atividade->prazo}}</h5>
                                <br>
                                
                            </div>

                        </a>
                    @endif
                
                
                <br>
            @endforeach
            {{-- ======================== ATIVIDADES EM GRUPO ======================== --}}
            <h3>Grupo</h3>

            @foreach ($ativ as $atividade)
                @if ( $atividade->tipo_destinatario == 2 && $atividade->destinatario == $id_user)
                    <a href="atividades{{$atividade->id}}" style=" color:white; text-decoration: none;">
                        <div style="background: rgb(75, 74, 72);
                            border-radius: 15px; width: 600px">
                            
                            
                            <h4>{{$atividade->atividade}}</h4>
                            <h5>Descrição: {{$atividade->descricao}}</h5>
                            <h5>Data de entrega: {{$atividade->prazo}}</h5>
                            
                            
                        
                        </div>
                    </a>
                
                @endif
            @endforeach
        @else
        {{-- ======================== DETALHES DA ATIVIDADE ======================== --}}
            @if ($permissao == 3)
                @foreach ($ativ as $atividade)
                    @if ($id == $atividade->id && $atividade->destinatario == $id_user)
                        <h3>Detalhes da Atividade</h3>
                        <div style="background: rgb(75, 74, 72); border-radius: 15px; width: 600px">

                            <h4>{{$atividade->atividade}}</h4>
                            <h5>Destinatário:
                                @foreach ($equipes as $equipe)
                                    @if ($equipe->id == $atividade->destinatario)
                                        {{$equipe->equipe}}
                                    @endif
                                @endforeach
                            </h5>
                            <h5>Descrição: {{$atividade->descricao}}</h5>
                            <h5>Data de entrega: {{$atividade->prazo}}</h5>

                        </div>
                    
                    @endif
                @endforeach
                <div style="font-size:18px;font-weight:bolder;"><a href="{{ url('/atividades') }}">Voltar</a></div>
            @endif
        @endif

        


{{-- ======================== caso seja adm ou gerente ======================== --}}
        @if ($id == null && $permissao == 1 || $permissao == 2)
        {{-- ======================== ATIVIDADES INDIVIDUAIS ======================== --}}
            <h3>Individual</h3>
            @foreach ($ativ as $atividade)
        
                    @if ( $atividade->tipo_destinatario == 1)
                        <a href="atividades{{$atividade->id}}" style=" color:white; text-decoration: none;">

                            <div style="background: rgb(75, 74, 72);
                            border-radius: 15px; width: 600px">
                                {{$id;}}
                                <br>
                                <h4>{{$atividade->atividade}}</h4>
                                <h5>Destinatário: 
                                    @foreach ($users as $user)
                                        @if ($user->id == $atividade->destinatario)
                                            {{$user->name}}
                                        @endif
                                    @endforeach
                                </h5>
                                <h5>Descrição: {{$atividade->descricao}}</h5>
                                <h5>Data de entrega: {{$atividade->prazo}}</h5>
                                <br>
                                
                            </div>

                        </a>
                    @endif
                
                
                <br>
            @endforeach
            {{-- ======================== ATIVIDADES EM GRUPO ======================== --}}
            <h3>Grupo</h3>

            @foreach ($ativ as $atividade)
                @if ( $atividade->tipo_destinatario == 2)
                    <a href="atividades{{$atividade->id}}" style=" color:white; text-decoration: none;">
                        <div style="background: rgb(75, 74, 72);
                            border-radius: 15px; width: 600px">
                            
                            
                            <h4>{{$atividade->atividade}}</h4>
                            <h5>Destinatário:
                                @foreach ($equipes as $equipe)
                                    @if ($equipe->id == $atividade->destinatario)
                                        {{$equipe->equipe}}
                                    @endif
                                @endforeach
                            </h5>
                            <h5>Descrição: {{$atividade->descricao}}</h5>
                            <h5>Data de entrega: {{$atividade->prazo}}</h5>
                            
                            
                        
                        </div>
                    </a>
                
                @endif
            @endforeach
        @else
        {{-- ======================== DETALHES DA ATIVIDADE ======================== --}}
            @foreach ($ativ as $atividade)
                @if ($id == $atividade->id)
                    <h3>Detalhes da Atividade</h3>
                    <div style="background: rgb(75, 74, 72); border-radius: 15px; width: 600px">

                        <h4>{{$atividade->atividade}}</h4>
                        <h5>Id: {{$atividade->id}}</h5>
                        <h5>Destinatário: 
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
                        </h5>
                        <h5>Descrição: {{$atividade->descricao}}</h5>
                        <h5>Data de entrega: {{$atividade->prazo}}</h5>
                        <h5>Finalização: {{$atividade->finalizacao}}</h5>
                        <h5>Dificuldade: {{$atividade->dificuldade}}</h5>

                    </div>
                   
                @endif
            @endforeach
            <div style="font-size:18px;font-weight:bolder;"><a href="{{ url('/atividades') }}">Voltar</a></div>
        @endif
        <div style="font-size:18px;font-weight:bolder;"><a href="{{ url('/atividades/criar_form') }}">Cadastrar nova atividade</a></div>
    </div>
@endsection