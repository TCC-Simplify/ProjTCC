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
        

        <form action="{{ url('/atividades/criar')}}" method="POST" enctype="multipart/form-data" class="form-cad">
            {!! csrf_field() !!} {{-- usado para imprimir html --}}
                <div class="form-group">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Título da Atividade:" required>
                </div>

                <div class="form-group">
                    <textarea name="descricao" placeholder="Descrição da atividade" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="prazo">Data de entrega:</label>
                    <input type="date" class="form-control" id="prazo" name="prazo" required>
                </div>

                <div class="form-group">
                    <select id="dificuldade" name="dificuldade" style="height:40px;">
                        <option value="" selected disabled hidden>Selecione a dificuldade: </option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                

{{-- 
                <script>
                    function mostra()
                    {
                        var individual = document.getElementsByClassName("individual");
                        var grupo = document.getElementById("grupo");
                        var mostra_indiv = document.getElementsByClassName("indiv")
                        
                        
                        
                            mostra_indiv.classList = "mostra";
                            // mostra_indiv.classList("mostra");
                        
                        if(valor == 2)
                        {
                            
                            individual.classList
                        }
                    }
                    function mostra_grupo()
                    {

                    }
                </script> --}}




                <div class="form-group">
                    <label>Selecione qual o tipo da atividade:</label>
                    <br>
                    <input type="radio" name="tipo_destinatario" id="individual" class="individual" value="1" onselect="mostra();">
                    <label for="individual">Individual</label>
                    
                    <input type="radio" name="tipo_destinatario" id="grupo" value="2">
                    <label for="grupo">Grupo</label>
                </div>


                
 
                {{-- <style>

                    .mostra
                    {
                        display: none;
                    }

                </style> --}}



                <div class="form-group" id="ativ">
                    <select id="destinatario" name="destinatario" style="height:40px;" class="indiv">
                        <option value="" selected disabled hidden>Selecione usuário ou equipe: </option>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
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