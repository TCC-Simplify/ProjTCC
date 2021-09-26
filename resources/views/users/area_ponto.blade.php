<!doctype html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link href="{{ asset('css/ponto.css') }}" rel="stylesheet">

    <title>Simplify</title>
  </head>

  <body>
    <div id="navbar">
        <div id="nav-logo">
            <a href="{{ url('/') }}"><img src="{{ url('/imgs/logo_simplify.png') }}" alt="Logo Simplify"></a>
        </div>

        @if (Route::has('login'))
        <div id="nav-link">
            <a href="{{ url('/') }}">VOLTAR</a>
        </div>
        @endif

    </div>
    <div id="fundo">
      <div id="container" class="animar">
        <div id="header">
          <h2>Registrar horário de entrada</h2>
          <div id="underline"></div>
        </div>
        <form method="post" action="{{ url('/ponto')}}">
          {{ csrf_field() }} 
          
          <div>
            <label class="titulo2">NOME</label><br>
            <input type="text" class="input-valor-fixo" name="fnome" value="{{ Auth::user()->name }}" disabled>   
          </div>
          
          <div>
            <label class="titulo2">HORÁRIO</label><br>
            <div class="input-valor-fixo" id="hora"></div>
          </div>
          <label class="titulo2">MOTIVO</label><br>
          <div id="div-select">
            <select name="motivo">
              <option value="1">Entrada</option>
              <option value="2">Volta de intervalo</option>
            </select>
          </div>
          <div id="div-botao">
            <input type="submit" name="botao" value="CONFIRMAR">
          </div>

       </form>
      </div>
    </div>

  <script type="text/javascript">
      $(window).on('load', function() {
          $('#modalPonto').modal('show');
      });
  </script>

  <script>
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
  </body>
</html>