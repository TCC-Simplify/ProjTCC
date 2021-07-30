<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Simplify</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!-- Style -->
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    </head>
    <body>
        <div id="navbar">
            <div id="nav-logo">
                <a href="{{ url('/') }}"><img src="{{ url('/imgs/logo_simplify.png') }}" alt="Logo Simplify"></a>
            </div>

            @if (Route::has('login'))
            <div id="nav-link">
                @if (Auth::check())
                    <a href="{{ url('/users') }}">Home</a>
                @else
                    <a href="{{ url('/login') }}">Login</a>
                @endif
            </div>
            @endif

            </div>
        </div>

        <div id="layout-main">
            <div id="main-imagem">
                <img id="img1" src="{{ url('/imgs/welcome/foto1.svg') }}" alt="Mulher em home-office" class="animar">
            </div>
            <div id="main-texto">
                <div id="bloco-texto">
                    <h1 id="t1" class="animar-delay">O Simplify dá suporte à sua empresa home-office.</h1>
                    <br>
                    <h5 id="t2" class="animar-delay">Realize o gerenciamento dos seus funcionários, com nosso sistema de ponto, organização das tarefas, overview de cada funcionário e de sua produtividade, mural de avisos e um chat para a comunicação de toda a empresa.</h5>
                </div>
                <div id="bloco-botao">
                    <a href="{{ url('/cadastro')}}"><button id="btn_cad" class="animar-delay">Cadastre-se</button></a>
                </div>
            </div>
        </div>
        </div>

        <div id="sombra"></div>
        <div id="layout-escuro">
            <h1 id="t3">Comece cadastrando sua empresa e seus funcionários.</h1>
            <br>
            <h5 id="t4">O Simplify ajuda você, empresário, a gerenciar sua empresa com eficiência e facilidade, reduzindo os custos e o tempo dos processos e tendo uma equipe mais automatizada.</h5>
            <div class="comeca-but">
                <a href="{{ url('/cadastro')}}"><button id="btn_comecar">Começar</button></a>
            </div>
            <img src="{{ url('/imgs/welcome/foto2.svg') }}" alt="Mulheres trabalhando" id="img2">
        </div>
        <div class="sombrab"></div>

        <div id="layout-sobre">
            <div id="sobre-imagem">
                <img src="{{ url('/imgs/welcome/foto3.png') }}" alt="Equipe Simplify" id="img3">
            </div>
            <div id="sobre-texto">
                <h1 id="t5">Sobre a equipe Simplify!</h1>
                <br>
                <h5 id="t6">Somos estudantes do 3° ano de informática, do Colégio Técnico Industrial "Prof. Isaac Portal Rondán". O Simplify é nosso projeto de TCC e o nosso orientador é o Professor Mestre Rodrigo Ferreira de Carvalho.</h5>
                <div id="email-but">
                    <a href="{{ url('/emails')}}"><button id="btnSobre">Entrar em contato</button></a>
                </div>
            </div>
            
        </div>

        <!-- Change Color on Scroll -->
        <script>
            function changeBg() {
                var scrollValue = window.scrollY;
                console.log(scrollValue);
                if(scrollValue < 150) {
                    navbar.classList.remove('bgColor');
                    t3.classList.remove('animar');
                    t4.classList.remove('animar');
                    btn_comecar.classList.remove('animar');
                    img2.classList.remove('animar');
                } else {
                    navbar.classList.add('bgColor');
                }
                if(scrollValue < 700) {
                    img1.classList.add('animar');
                    t1.classList.add('animar');
                    t2.classList.add('animar');
                    btn_cad.classList.add('animar');
                } else {
                    img1.classList.remove('animar');
                    t1.classList.remove('animar-delay');
                    t2.classList.remove('animar-delay');
                    t1.classList.remove('animar');
                    t2.classList.remove('animar');
                    btn_cad.classList.remove('animar-delay');
                    btn_cad.classList.remove('animar');
                }
                if(scrollValue > 150 && scrollValue < 1710) {

                    t3.classList.add('animar');
                    t4.classList.add('animar');
                    btn_comecar.classList.add('animar');
                    img2.classList.add('animar');
                }
                if(scrollValue < 1000) {
                    t5.classList.remove('animar');
                    t6.classList.remove('animar');
                    img3.classList.remove('animar');
                    btnSobre.classList.remove('animar');
                }
                if(scrollValue > 1000 && scrollValue < 1810) {
                    t5.classList.add('animar');
                    t6.classList.add('animar');
                    img3.classList.add('animar');
                    btnSobre.classList.add('animar');
                }
                if(scrollValue > 1710) {
                    t3.classList.remove('animar');
                    t4.classList.remove('animar');
                    btn_comecar.classList.remove('animar');
                    img2.classList.remove('animar');
                }
            }

            window.addEventListener ('scroll', changeBg);
        </script>
    </body>
</html>

