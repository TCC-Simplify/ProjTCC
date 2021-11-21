@extends('layouts.fundo_padrao')

@section('titulo')
  <h1>Histórico de pontos</h1>
@endsection

@section('direita')
    <div class="direita cad_user">
        <div id="container">
            <div id="nome">
                <h3>Nome Completo: </h3>
                <br>
                <input class="input-valor-fixo" type="text" name="fnome" value="{{ Auth::user()->name }}" disabled>    
            </div> 
            
            <div id="historico">
    
                <form action="{{ url('/historico_ponto')}}" method="get">
                    <div class="filter">
                        <div class="form-group">
                            <label for="prazo">Data inicial:</label>
                            <input type="date" class="form-control" id="data_inicial" name="data_inicial">
                        </div>
                        <div class="form-group">
                            <label for="prazo">Data final:</label>
                            <input type="date" class="form-control" id="data_final" name="data_final">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="filter-button" name="filter" value="filter"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <h3>Histórico: </h3></br>
                <form action="{{ url('/justificativa/form')}}" method="post" enctype="multipart/form-data" id="modalPonto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    {{ csrf_field() }}  

                    @foreach ($hist as $linha)
                        <div id="linha">
                            <div id="sublinha1">
                                <div id="motivo">
                                    @if ($linha->motivo == 1)
                                    <h5>Entrada</h5>
                                    @endif

                                    @if ($linha->motivo == 2)
                                    <h5>Volta de Intervalo</h5>
                                    @endif

                                    @if ($linha->motivo == 3)
                                    <h5>Saída</h5>
                                    @endif
                                    </br>
                                </div>
                            </div>
                            <div id="sublinha2">
                                <div id="data">
                                    <label><?php echo str_replace('-', '/', date( 'd-m-Y H:i:s' , strtotime( $linha->created_at ) ));?></label>&nbsp;
                                </div>
                                
                                <div id="div-botao">
                                    <input type="hidden" name="ponto" value="{{$linha->id}}">
                                    @if($tem)
                                        @foreach ($just as $aux) 
                                            @if($aux->ponto != $linha->id)
                                                <input type="submit" name="botao" value="Justificar">
                                            @else
                                                <h2 style="color: coral; font-weight: bold;">Justificado</h2>
                                            @endif
                                        @endforeach
                                    @else
                                        <input type="submit" name="botao" value="Justificar">
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    @endforeach
                </form>
            </div>
                
        </div>
            
    </div>

  <script>
    $(window).on('load', function() {
        $('#modalPonto').modal('show');
    });
    
    setInterval(function(){
        let novaHora = new Date(); 
        let hora = novaHora.getHours();
        let minuto = novaHora.getMinutes();
        let segundo = novaHora.getSeconds();
        minuto = zero(minuto);
        segundo = zero(segundo);
        document.getElementById('hora').textContent = hora+':'+minuto+':'+segundo;
    },1000)

    function zero(x) {
        if (x < 10) {
            x = '0' + x;
        } return x;
    }
  </script>
@endsection