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
    <!-- nao sei se precisam estar aqui -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
        
        <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@vsilva472/jquery-viacep/dist/jquery-viacep.min.js"></script>
        <script src="<?php echo asset('js/jquery.maskedinput-1.1.4.pack.js')?>" type="text/javascript"></script>
        <script src="<?php echo asset('js/funcs_cad_profissional.js')?>"></script> 
    
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
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
                <div><h2>Login</h2></div>
            </div>
            <form  role="form login" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <div class="label-float">
                    <input type="email" placeholder="Digite seu email" name="email" value="{{ old('email') }}" required>
                    <label>E-mail</label>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    <div class="underline"></div>
                </div>
                <div class="label-float" id="input-2">
                    <input type="password"  placeholder="Digite sua senha" name="password" required>
                    <label style="font-weight: 400;">Senha</label>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <div class="underline"></div>
                </div>
                <div id="lembrar">
                        <input id="checkbox-1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> 
                        <label for="checkbox-1">Lembre de mim</label>
                </div>
                <button id="entrar"type="submit">
                    ENTRAR
                </button>
                <div class="links">
                    <div class="link1">
                        <a href="{{ url('/forgot-password') }}">
                            Esqueceu sua senha?
                        </a>
                    </div>
                    <div id="link2" class="link1">
                    <a href="{{ url('/cadastro') }}">
                        Não possui conta?
                    </a>
                </div>
                </div>
            </form>
        </div>
        
    </main>

</body>
</html>
