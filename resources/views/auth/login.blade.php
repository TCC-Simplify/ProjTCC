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
        <link href="{{ asset('css/user_e_empresa/cadastro_e_login.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
        
        <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@vsilva472/jquery-viacep/dist/jquery-viacep.min.js"></script>
        <script src="<?php echo asset('js/jquery.maskedinput-1.1.4.pack.js')?>" type="text/javascript"></script>
        <script src="<?php echo asset('js/funcs_cad_profissional.js')?>"></script> 
    
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(), 
        ]); ?>
    </script> 

    <!-- Styles -->
    <style>
        * {
            font-weight: 100;
            margin: 0;
            border: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }
        body {
            background: linear-gradient(90deg, #edf2f4, #4a00e0);
            background-repeat: no-repeat;
            min-height: 100vh;
            min-width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        main.container {
            background: #212529;
            width: 446px;
            min-height: 50vh;
            padding: 2rem;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }
        main h2 {
            font-weight: 600;
            font-size: 3rem;
            margin-bottom: 2rem;
            position: relative;
        }
        .input-field {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-field .underline::before {
            content: '';
            position: absolute;
            height: 1px;
            width: 100%;
            bottom: -5px;
            left: 0px;
            background: #fff;
        }
        .input-field .underline::after {
            content: '';
            position: absolute;
            height: 1px;
            width: 100%;
            bottom: -5px;
            left: 0px;
            background: linear-gradient(90deg, #4a00e0, #edf2f4);
            transform: scaleX(0);
            transition: all .3s ease-in-out;
            transform-origin: left;
        }

        .input-field input:focus ~ .underline::after{
            transform: scaleX(1);
        }
        .input-field input {
            background-color: #212529;
            outline: none;
            font-size: 1.5rem;
            color: rgba(ed, f2, f4, 0.7);
            width: 400px;
        }
        .input-field p {
            font-size: 2rem;
            color: #fff;
        }
        .input-field input::placeholder {
            color: rgba(ed, f2, f4, 0.7);
        }
        input:-webkit-autofill,
        textarea:-webkit-autofill,
        select:-webkit-autofill {
            -webkit-text-fill-color: #FFF;
            -webkit-box-shadow: 0 0 0px 1000px #212529 inset;
        }
        
        #entrar{
            margin-top: 2rem;
            padding: 0.4rem;
            background: linear-gradient(90deg, #4a00e0, #3c096c);
            font-size: 1.5rem;
            font-weight: 600;
            border-radius: 26px;
            transition: all 0.3s ease;
            height: 44px;
            width: 100%;
            position: relative;
        }
        #check {
            font-size: 3rem;
        }
        .links {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
        }
        .link1 {
            padding-top: 3rem;
        }
        .link1 a {
            text-decoration: none;
            color: #c77dff;
            font-size: 1.5rem;
            font-weight: 300;
            padding: 1rem;
        }
        .link1 a:hover{
            color: #e0aaff;
            background: #343a40;
        }
        #header {
            display: flex;
            margin-bottom: 2vh;
        }
        #voltar {
            margin-left: auto;
        }
        #voltar a{
            text-decoration: none;
            font-size: 17px;
            color: #edf2f4;
            padding: 1rem;
        }
        #voltar a:hover {
            color: #e0aaff;
        }
    </style>
</head>
<body>
    <main class="container">
        <div id="header">
            <div><h2>Login</h2></div>
            <div id="voltar">
                <a href="{{ url('/') }}">VOLTAR</a>
            </div>
        </div>
        <form  role="form login" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <div class="input-field">
                <p style="font-weight: 400;">E-mail</p>
                <input type="email" placeholder="Digite seu email" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <div class="underline"></div>
            </div>
            <div class="input-field">
                <p style="font-weight: 400;">Senha</p>
                <input type="password"  placeholder="Digite sua senha" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <div class="underline"></div>
            </div>
            <div style="display: flex; padding-top: 0.5rem">
                    <input  type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> 
                    <p style="font-size: 1.5rem; padding-left: 0.5rem">Lembre de mim</p>
            </div>
            
            <button id="entrar"type="submit">
                ENTRAR
            </button>
            <div class="links">
                <div class="link1">
                    <a href="{{ url('/password/reset') }}">
                        Esqueceu sua senha?
                    </a>
                </div>
                <div class="link1">
                <a href="{{ url('/cadastro') }}">
                    Criar conta
                </a>
            </div>
            </div>
        </form>
    </main>

</body>
</html>
