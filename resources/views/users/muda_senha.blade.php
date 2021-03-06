<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="{{ asset('css/user_e_empresa/cadastro_e_login.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@vsilva472/jquery-viacep/dist/jquery-viacep.min.js"></script>
        <script src="<?php echo url('js/jquery.maskedinput-1.1.4.pack.js')?>" type="text/javascript"></script>
        <script src="<?php echo url('js/funcs_cad_empresa.js')?>"></script>      <script src="<?php echo asset('js/funcs_cad_profissional.js')?>"></script> 
         <script src="<?php echo asset('js/funcs_cad_profissional.js')?>"></script> 
    

        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>

    <body>
        <div id="navbar">
            <div id="nav-logo">
                <a href="{{ url('/login') }}"><img src="{{ url('/imgs/logo_simplify.png') }}" alt="Logo Simplify"></a>
            </div>

            @if (Route::has('login'))
            <div id="nav-link">
                <a href="{{ url('/login') }}">VOLTAR</a>
            </div>
            @endif

            </div>
        </div>
        <div id="fundo">
            <div id="container" class="animar">
                <div id="header">
                    <h3>Configurar senha</h3>
                    <div id="underline"></div>
                </div>
            

            <form action="{{ url('/log/muda_senha')}}" method="post" id="form" enctype="multipart/form-data" class="form" data-viacep>
                {{ csrf_field() }}
                <div class="label-float">
                    <input type="password" id="senha2" name="senha" required>
                    <label>NOVA SENHA</label>
                </div>
                <button style="background-color: transparent" type="button" onclick="mostrarSenha2()" class="ver"><i class="fas fa-eye"></i></button>
            
                
                <div id="div-botao">
                    <input type="submit" name="botao" value="CONTINUAR" class="btn-enviar">
                </div>
            </form>
            </div>
        </div>

        </body>

</html>



    