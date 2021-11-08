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
        <div class="a"><a href="{{ url('/mural') }}"><i class="fas fa-calendar-alt es"></i></a></div>
        <div class="a"><a href="{{ url('/atividades') }}"><i class="fas fa-list-ul"></i></a></div>
        <div class="a"><a href="{{ url('/chat') }}"><i class="fas fa-comments"></i></a></div>
    </div>
@endsection

@section('titulo')
    <h1>Página do Mural</h1>
@endsection

@section('direita')
    <div class="direita cad_user">
        <br>
        
        @if(Auth::user()->permissao == 2 || Auth::user()->permissao == 1)
            <div class="header">
                <a href="{{ url('/mural/form_criar_aviso') }}" class="ir"><p>Novo aviso &#8594;</p></a>   
            </div>
        @endif
        <br>
        <br>
        {{-- ======================== EXIBE TODOS OS AVISOS ======================== --}}
        <div name="exibe_todos_avisos" id="exibe_todos_avisos">
            
            
            @if ($tem_aviso)
                @foreach ($avisos as $aviso)
                    <div class="card-o">
                        <div name="avisos" id="avisos">
                            <div style="text-align: center;font-size: 22px;font-weight: bold;">{{$aviso->titulo}}</div>
                            @foreach ($user as $responsavel)
                                @if ($responsavel->id == $aviso->responsavel)
                                    <div style="margin-left: 10px;text-align: center;"><b>Responsável:</b> {{$responsavel->name}}</div>
                                @endif
                            @endforeach
                            <br>
                            <div style="margin-left: 10px;"><b>Descrição:</b> {{$aviso->descricao}}</div>
                            @if($aviso->img)
                                  <img src="data:image/jpeg;base64, <?= $aviso->img ?>"></img>
                            @endif
                            <br>
                            @if ($aviso->video) 
                            <video width="320" height="240" controls>
                                <source src="data:video/mp4;base64, <?= $aviso->video ?>" type="video/mp4">
                            </video>
                            @endif
                            @if ($aviso->imagem != null)
                                {{$aviso->imagem}}
                            @endif
                            <!--<div style="margin-left: 10px;"><b>Duração:</b> {{$aviso->duracao}} horas </div>-->
                            <div style = "text-align: right">
                                <a href="{{ url('/mural/marcar_concluido', $aviso->id) }}"><b>Concluir</b></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No momento não há nenhum aviso</p>
            @endif
        </div>
        
        
        <!-- <p>Aqui estará disponível todos os avisos, além de um calendário onde contará as datas de reuniões.</p> -->
    </div>
@endsection