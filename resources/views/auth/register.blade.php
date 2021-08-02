<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="{{ asset('css/cadastro.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@vsilva472/jquery-viacep/dist/jquery-viacep.min.js"></script>
    <script src="<?php echo url('js/jquery.maskedinput-1.1.4.pack.js')?>" type="text/javascript"></script>
    <script src="<?php echo url('js/funcs_cad_profissional.js')?>"></script> 
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(), 
        ]); ?>
    </script> 
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
    </div>
    <div id="fundo">
        <div id="container" class="animar">
            <div id="header">
                <div><h2>Cadastro do administrador</h2></div>
            </div>
            <form role="form" method="post" action="{{ url('register') }}">
                {{ csrf_field() }}
                <div class="etapas">
                    <h4 style="color: rgb(95, 185, 151);">Empresa</h4>
                    <img src="{{ url('/imgs/cad_empresa/seta.png') }}" alt="Logo Simplify"  width="70px">
                    <h4 style="color: rgb(95, 185, 151);">Administrador</h4>
                </div>

                <div class="label-float input-longo">
                    <input id="name" type="text"  name="name" placeholder="NOME:" value="{{ old('name') }}" required>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    <label>NOME</label>
                </div>

                <div class="label-float input-longo">
                    <input id="email" type="email" name="email" placeholder="E-MAIL:" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    <label>E-MAIL</label>
                </div>

                <div class="label-float input-longo">
                    <input id="cpf" type="text" name="cpf" placeholder="CPF:" value="{{ old('cpf') }}" required>
                    @if ($errors->has('cpf'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cpf') }}</strong>
                        </span>
                    @endif
                    <label>CPF</label>
                </div>

                <div class="label-float input-longo">
                    <input id="dt_nasc" type="text" name="dt_nasc" placeholder="DATA DE NASCIMENTO:" value="{{ old('dt_nasc') }}" required>
                    <label>DATA DE NASCIMENTO</label>
                </div>
                
                <div class="label-float input-longo">
                    <input id="funcao" type="text" name="funcao" placeholder="SETOR:" value="{{ old('funcao') }}" required>
                    @if ($errors->has('funcao'))
                        <span class="help-block">
                            <strong>{{ $errors->first('funcao') }}</strong>
                        </span>
                    @endif
                    <label>SETOR</label>
                </div>

                <div class="filled">
                    <div class="label-float input-cinquenta">
                        <input id="password" type="password" placeholder="SENHA:" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <label>SENHA</label>
                    </div>
                    
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <div class="label-float input-cinquenta">
                        <input id="password-confirm" type="password" placeholder="CONFIRMAR SENHA:" name="password_confirmation" required>
                        <label>CONFIRMAR SENHA</label>
                    </div>
                </div>

                <div class="filled">
                    <div class="input-cinquenta">
                        <button type="button" onclick="mostrarSenha3()" class="ver"><i id="botao" class="fas fa-eye"></i></button>
                    </div>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <div class="input-cinquenta">
                        <button type="button" onclick="mostrarSenha4()"class="ver"><i id="botao2" class="fas fa-eye"></i></button>  
                    </div>
                </div>
                <div id="div-botao">
                    <input type="submit" name="botao" value="CADASTRAR">
                </div>
                
                <input id="permissao" type="text" class="form-control tam" name="permissao" value="1" style="display: none;">
            </form>
        </div>
    </div>

</body>
</html>


