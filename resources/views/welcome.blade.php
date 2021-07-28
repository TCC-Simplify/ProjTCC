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

        <!-- Styles -->
        <style>
            html, body {
                /**background-color: rgb(37, 37, 44);**/
                background-color: #edf2f4;
                color: #000;
                font-family: 'Poppins', sans-serif;
                font-weight: 100;
                height: 100%;
                margin: 0;
                
            }

            .links > a {
                color: rgb(0, 0, 0);
                padding: 0 25px;
                font-size: 25px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                text-align: right;
            }
            .links > a:hover{
                border-bottom: 1px solid rgb(155, 155, 155);
            }

            .links{
                text-align: right;
            }
            
            .cadastre-se{
                padding-left: 100px;
                padding-top: 90px;
                text-align: justify; 
            }

            .desc-cad{
                position: relative;
                padding-left: 600px;
                padding-right: 100px;
                padding-top: 100px;
            }

            .cad-but{
                text-align: center;
                margin-top: 40px;
            }

            #btn_cad{
                width: 20vw;
                height: 10vh;
                border-radius: 15px;
                color: #fff;
                background-color: rgb(95, 185, 151);
                cursor: pointer;
                font-size: 3vh;
                margin-top: 10vh;
                opacity: 0;
                border: 0;
            }
            .btn-cad:hover, .btn-emails:hover{
                background-color: rgb(58, 141, 109);
            }

            /*.btn-comecar{
                margin-top: 30px;
                width: 200px;
                height: 50px;
                border: 1px solid rgb(95, 185, 151);
                border-radius: 4px;
                color: rgb(95, 185, 151);
                cursor: pointer;
                background-color: rgb(37, 37, 44);
            }
            .btn-comecar:hover{
                border: 1px solid #555;
                color: white;
                background-color: rgb(95, 185, 151);
            }*/

            
            #btn_comecar{
                margin-top: 30px;
                margin-bottom: 30px;
                width: 200px;
                height: 50px;
                border: 1px solid #555;
                border-radius: 4px;
                color: #fff;
                cursor: pointer;
                background-color: #555;
                opacity: 0;
            }
            #btn_comecar:hover{
                border: 1px solid rgb(61, 60, 60);
                color: white;
                background-color: rgb(61, 60, 60);
            }

            .sombra{
                margin-top: 230px;
                padding-top: 30px;
                /**background-color: rgb(135, 202, 176);**/
                background-color: #1b2029;
                margin-top: 230px;
                box-shadow: 0px -11px 10px black;
                border: none;
            }

            .publi-1{
                text-align: center;
                padding-left: 90px;
                padding-right: 90px; 
                /**background-color: rgb(135, 202, 176);**/
                background-color: #1b2029;
                color: rgb(37, 37, 44);
                height: 95vh;
            }

            .sombrab{
                padding-top: 30px;
                background-color: #1b2029;
                box-shadow: 0px 11px 10px black;
                border: none;
            }

            hr{
                background-color: rgb(50, 50, 56);
                width: 85%;
            }

            #sobre{
                text-align: center;
                margin-top: 100px;
                padding-left: 90px;
                padding-right: 90px; 
                padding-bottom: 60px;
                height: 70vh;
            }

            .btn-emails{
                margin-top: 30px;
                width: 250px;
                height: 50px;
                border: 0;
                border-radius: 4px;
                background-color: rgb(95, 185, 151);
                cursor: pointer;
            }
            .bgColor {
                background-color: white;
                color: black;
                border-bottom: 1px solid lightgray;
            }
            #navbar{
                position: fixed;
                width: 100%;
                color: white;
                padding: 10px;
                z-index: 1;
            }

            #logo {
                position: relative;
                float: left;
            }

            #link {
                position: relative;
                float: right;
                padding-top:20px;
            }

            #principal {
                height: 80vh;
                padding-top: 10vh;
            }

            #img1 {
                display: flex;
                width: 50vw;
                float: left;
                padding-top: 10vh;
                padding-left: 3vw;
                padding-right: 3vw;
                opacity: 0;
            }
            #img2 {
                align-items: center;
                width: 75vw;
                height: 50vh;
                opacity: 0;
            }
            #img3 {
                display: flex;
                width: 60vw;
                float: left;
                transform: translateX(-50px);
            }
            #t1 { 
                font-size: 5vh;
                opacity: 0;
            }
            #t2{
                font-size: 3vh;
                opacity: 0;
            }
            #t3 {
                font-size: 5vh;
                opacity: 0;
                color: #edf2f4;
                transform: translateX(-50px);
            }
            #t4 {
                font-size: 3vh;
                opacity: 0;
                color: #edf2f4;
                transform: translateX(-50px);
            }
            #t5 {
                font-size: 5vh;
                opacity: 0;
            }
            #t6 {
                font-size: 3vh;
                opacity: 0;
                text-align: left;
            }
            .animar {
                animation-name: slide;
                animation-duration: 1s;
                animation-fill-mode: forwards;
            }
            .animar-delay {
                animation-name: slide;
                animation-duration: 1s;
                animation-delay: 0.5s;
                animation-fill-mode: forwards;
            }
            
            @keyframes slide {
                from {
                    opacity: 0;
                    transform: translateX(-100px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0px);
                }  
            }

            @keyframes toggle {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }
            .cadastre-se {
                padding-right: 5vw;
            }
        </style>
    </head>
    <body>
        <div id="navbar">
            <div id="logo">
                <a href="{{ url('/') }}"><img src="{{ url('/imgs/logo_simplify.png') }}" alt="Logo Simplify"  width="250vw"></a>
            </div>
                @if (Route::has('login'))
                <div id="link" class="links">
                    @if (Auth::check())
                        <a href="{{ url('/users') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                    @endif
                </div>
                @endif
            </div>
        </div>


        <div id="principal" class="container-fluid">
            <img src="{{ url('/imgs/welcome/foto1.svg') }}" alt="Mulher em home-office" id="img1" class="animar">
            <div class="cadastre-se">
                    <h1 id="t1" class="animar-delay">O Simplify dá suporte à sua empresa home-office.</h1>
                    <br>
                    <h5 id="t2" class="animar-delay">Realize o gerenciamento dos seus funcionários, com nosso sistema de ponto, organização das tarefas, overview de cada funcionário e de sua produtividade, mural de avisos e um chat para a comunicação de toda a empresa.</h5>
                    <div class="cad-but">
                        <a href="{{ url('/cadastro')}}"><button id="btn_cad" class="animar-delay">Cadastre-se</button></a>
                    
                </div>
            </div>
        </div>

        <div class="sombra"></div>
        <div id="publi-1" class="publi-1">
            <h1 id="t3">Comece cadastrando sua empresa e seus funcionários.</h1>
            <br>
            <h5 id="t4">O Simplify ajuda você, empresário, a gerenciar sua empresa com eficiência e facilidade, reduzindo os custos e o tempo dos processos e tendo uma equipe mais automatizada.</h5>
            <div class="comeca-but">
                <a href="{{ url('/cadastro')}}"><button id="btn_comecar">Começar</button></a>
            </div>
            <img src="{{ url('/imgs/welcome/foto2.svg') }}" alt="Mulheres trabalhando" id="img2">
        </div>
        <div class="sombrab"></div>

        <div id="sobre">
            <img src="{{ url('/imgs/welcome/foto3.png') }}" alt="Equipe Simplify" id="img3">
            <h1 id="t5">Sobre a equipe Simplify!</h1>
            <br>
            <h5 id="t6">Somos estudantes do 3° ano de informática, do Colégio Técnico Industrial "Prof. Isaac Portal Rondán". O Simplify é nosso projeto de TCC e o nosso orientador é o Professor Mestre Rodrigo Ferreira de Carvalho.</h5>
            <div class="email-but">
                <a href="{{ url('/emails')}}"><button class="btn-emails">Entrar em contato</button></a>
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
                if(scrollValue < 1106) {
                    t5.classList.remove('animar');
                    t6.classList.remove('animar');
                }
                if(scrollValue > 1200 && scrollValue < 1810) {
                    t5.classList.add('animar');
                    t6.classList.add('animar');
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

