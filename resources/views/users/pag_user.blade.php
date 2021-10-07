<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Simplify</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
        <link href="{{ url('css/user_e_empresa/home_register.css') }}" rel="stylesheet">
        <link href="{{ url('css/user_e_empresa/cad_user.css') }}" rel="stylesheet">
        <link href="{{ url('css/user_e_empresa/mostrar_todos.css') }}" rel="stylesheet">
        <link href="{{ url('css/atividades.css') }}" rel="stylesheet">
        <link href="{{ url('css/overview.css') }}" rel="stylesheet">
        <link href="{{ url('css/msg.css')}}" rel="stylesheet">

        <!-- Scripts js -->
        <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@vsilva472/jquery-viacep/dist/jquery-viacep.min.js"></script>
        <script src="<?php echo url('js/jquery.maskedinput-1.1.4.pack.js')?>" type="text/javascript"></script>
        <script src="<?php echo url('js/funcs_cad_empresa.js')?>"></script> 
        <script src="<?php echo url('js/funcs_cad_profissional.js')?>"></script> 
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: rgb(37, 37, 44); 
                color: #fff;
                font-family: 'Poppins', sans-serif;
                font-weight: 100;
                height: 100vh;
                width: 100vw;
                margin: 0;
                display: grid;
                grid-template-rows: 10vh 90vh;
            }

            .links > a{
                color: rgb(0, 0, 0);
                padding: 0 25px;
                font-size: 25px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .links > a:hover{
                border-bottom: 1px solid rgb(155, 155, 155);
            }

            .links{
                text-align: right;
            }

            .opcoes > .a > a{
                color: rgb(0, 0, 0);
                font-size: 40px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .opcoes > .a > a:hover{
                color: rgb(37, 37, 44);
            }

            .users{
                text-align: center;
                display: grid;
                grid-template-rows: 15vh 15vh 15vh 15vh;
            }

            .empresa{
                text-align: center;
                display: grid;
                grid-template-rows: 20vh 20vh;
                margin-top: 80px;
            }

            .cima{
                background-color: red;
            }

            .tudo{
                background-color: green;
                display: grid;
                grid-template-columns: 90px auto;
            }

            .esquerda{
                background-color: rgb(38, 109, 82);
                padding-top: 10vh;
            }

            .direita{
                background-color: rgb(37, 37, 44);
                overflow: auto;
                text-align: center;
            }

            .navbar{
                height: 10vh;
            }

            .es{
                color: rgb(212, 212, 212);
            }

            #descricao{
                display:none; 
                position:absolute;
                width:100px; 
                background-color: rgba(150, 150, 150, 0.500);
                color: black;
                top:10px; 
                left: 1490px;
                text-align: center;
                border-radius: 4px;
            }

            chat {
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .chat li {
                margin-bottom: 10px;
                padding-bottom: 5px;
                border-bottom: 1px dotted #B3A9A9;
            }

            .chat li .chat-body p {
                margin: 0;
                color: #777777;
            }

            .panel-body {
                overflow-y: scroll;
                height: 350px;
            }

            ::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                background-color: #F5F5F5;
            }

            ::-webkit-scrollbar {
                width: 12px;
                background-color: #F5F5F5;
            }

            ::-webkit-scrollbar-thumb {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
                background-color: #555;
            }
        </style>

        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(), 
            ]); ?>
        </script>

        <!-- Gráficos -->
        <script type="text/javascript">
            // Load the Visualization API and the corechart package.
            google.charts.load('current', {'packages':['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {

                // Create the data table.
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Topping');
                data.addColumn('number', 'Slices');
                data.addRows([
                    <?php
                        for($x3=0; $x3 < 2; $x3++){
                            print_r("['".$array_leg[$x3]."', ".$array_quant[$x3]."],");
                        }
                    ?>
                ]);

                // Set chart options
                var options = {'title':'Quantidade de atividades realizadas',
                            pieSliceText: 'none',
                            is3D: true,
                            slices: {
                                0: { color: 'LightBlue' },
                                1: { color: 'LightSalmon' }
                            },
                            titleTextStyle: {
                                fontSize: 16,
                                bold: true,
                                color: 'white'
                            },
                            backgroundColor: {
                                fill: 'transparent',
                            },
                            legend: {textStyle: {color: 'white'}},
                            'width': 700,
                            'height':600};

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById('grafic_pizza1'));
                chart.draw(data, options);
            }
        </script>

        <script type="text/javascript">
            // Load the Visualization API and the corechart package.
            google.charts.load('current', {'packages':['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {

                // Create the data table.
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Topping');
                data.addColumn('number', 'Slices');
                data.addRows([
                    <?php
                        for($x3=0; $x3 < 3; $x3++){
                            print_r("['".$ativ_leg[$x3]."', ".$ativ_quant[$x3]."],");
                        }
                    ?>
                ]);

                // Set chart options
                var options = {'title':'Quantidade de atividades realizadas por dificuldade',
                            pieSliceText: 'none',
                            is3D: true,
                            slices: {
                                0: { color: 'DarkSeaGreen' },
                                1: { color: 'Khaki' },
                                2: { color: 'LightCoral'}
                            },
                            titleTextStyle: {
                                fontSize: 16,
                                bold: true,
                                color: 'white'
                            },
                            backgroundColor: {
                                fill: 'transparent',
                            },
                            legend: {textStyle: {color: 'white'}},
                            'width': 700,
                            'height':600};

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById('grafic_pizza2'));
                chart.draw(data, options);
            }
        </script>
    </head>
    <body> 
        <div class="cima"></div>
        <div class="navbar fixed-top bg-light">
            <div class="logo">
                <a href="{{ url('/mural') }}"><img src="{{ url('/imgs/logo_simplify.png') }}" alt="Logo Simplify"  width="250px"></a>
            </div>

            <div class="links">
                <div class="links">
                    <a href="{{ url('/pag_user') }}" style="color: rgb(38, 109, 82);">Usuários</a>
                    <a href="{{ url('/empresa') }}">Empresa</a>
                    <a href="{{ url('/atividades') }}">Controle</a>
                    <a class="log" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" onmouseover="getElementById('descricao').style.display='block'" onmouseout="getElementById('descricao').style.display='none'"><i class="fas fa-sign-out-alt"></i></a>
                    <form id="logout-form" action="{{ url('/ponto_confirma') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    <!--<div id="descricao" name="descricao">Sair</div>-->
                </div>
            </div>
        </div>
        <div class="tudo">
            <div class="esquerda">
                <div class="opcoes users">
                    <div class="a"><a href="{{ url('/pag_user') }}"><i class="fas fa-user es"></i></a></div>
                    <div class="a" <?php if(Auth::user()->permissao == 3) echo 'style="display: none;"'?>><a href="{{ url('/cadastro_user') }}"><i class="fas fa-user-plus"></i></a></div>
                    <div class="a" <?php if(Auth::user()->permissao == 3) echo 'style="display: none;"'?>><a href="{{ url('/users') }}"><i class="fas fa-users"></i></a></div>
                    <div class="a"><a href="{{ url('/overview') }}"><i class="fas fa-chart-area"></i></a></div>
                    <div class="a"><a href="{{ url('/dados_ponto') }}"><i class="fas fa-user-clock"></i></a></div>
                </div>
            </div>
            <div class="direita cad_user">
                <h1>Página do usuário</h1>
                <div class="graficos" style="display: grid; grid-template-columns: 1fr 1fr; padding:auto;">
                    <div id="grafic_pizza1"></div>
                    <div id="grafic_pizza2"></div>
                </div>

                <h1>Controle dos meus dados</h1>
                <a href="{{ url('/alt_user', Auth::user()->id) }}"><button class="btn-paguser">Alterar meu dados</button></a>
        </div>
        <script src="{{asset('js/msg.js')}}"></script>
    </body>
</html>
