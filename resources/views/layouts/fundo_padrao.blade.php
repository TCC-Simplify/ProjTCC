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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
        <link href="{{ asset('css/layout_fundo_padrao.css') }}" rel="stylesheet">

        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(), 
            ]); ?>
        </script>
    </head>
    <body>
            
        <div id="navbar">
            <div id="nav-logo">
                <a href="{{ url('/mural') }}"><img src="{{ url('/imgs/logo_simplify.png') }}" alt="Logo Simplify"></a>
            </div>
            @yield('titulo')
            <div id="logout">
                <a class="log" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i></a>
                <form id="logout-form" action="{{ url('/ponto_confirma') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form> 
            </div>
        </div>
        <div id="menu_lateral">
            <ul>
                <li>
                    <img id="img_usuario" src="{{ url('/imgs/layout/usuario.png') }}" alt="Icone Usuario">
                        <a href="#" id="label_usuario" class="usuario">
                            USUÁRIOS
                            <span class="material-icons seta1">keyboard_arrow_down</span>
                        </a>
                </li>
                <ul class="itens_usuario">
                    <li>
                        <i class="fas fa-user"></i>
                        <a href="{{ url('/pag_user') }}" class="itens mostra2">
                            Perfil do usuário
                        </a>
                    </li>
                    <li <?php if(Auth::user()->permissao == 3) echo 'style="display: none;"'?>>
                        <i class="fas fa-user-plus es"></i>
                        <a href="{{ url('/cadastro_user') }}" class="itens mostra2">
                            Cadastro de usuários
                        </a>
                    </li>
                    <li <?php if(Auth::user()->permissao == 3) echo 'style="display: none;"'?>>
                        <i class="fas fa-users"></i>
                        <a href="{{ url('/users') }}" class="itens mostra2">
                            Painel de usuários
                        </a>
                    </li>
                    <li>
                        <i class="fas fa-chart-area"></i>
                        <a href="{{ url('/overview') }}" class="itens mostra2">
                            Overview das atividades
                        </a>
                    </li>
                    <li>
                        <i class="fas fa-user-clock"></i>
                        <a href="{{ url('/dados_ponto') }}" class="itens mostra2">
                            Página ponto
                        </a>
                    </li>
                </ul>

                <li>
                    <img id="img_empresa" src="{{url('/imgs/layout/empresa.png') }}" alt="Icone Empresa">
                    <a href="#" id="label_empresa" class="empresa">
                        EMPRESA
                        <span class="material-icons seta2">keyboard_arrow_down</span>
                    </a>
                    
                </li>
                <ul class="itens_empresa">
                    <li>
                        <i class="fas fa-city es"></i>
                        <a href="{{ url('/empresa') }}" class="itens mostra2">
                            Perfil da empresa
                        </a>
                    </li>
                    <li>
                        <i class="fas fa-users"></i>
                        <a href="{{ url('/equipes') }}" class="itens mostra2" <?php if(Auth::user()->permissao == 3) echo 'style="display: none;"'?>>
                            Equipes
                        </a>
                    </li>
                </ul>

                <li>
                    <img id="img_controle" src="{{url('/imgs/layout/controle.png') }}" alt="Icone Controle">
                    <a href="#" id="label_controle" class="controle">
                        CONTROLE
                        <span class="material-icons seta3">keyboard_arrow_down</span>
                    </a>
                </li>
                <ul class="itens_controle">
                    <li>
                        <i class="fas fa-calendar-alt"></i>
                        <a href="{{ url('/mural') }}" class="itens mostra2">
                            Mural
                        </a>
                    </li>
                    <li>
                        <i class="fas fa-list-ul es"></i>
                        <a href="{{ url('/atividades') }}" class="itens mostra2">
                            Atividades
                        </a>
                    </li>
                    <li>
                        <i class="fas fa-comments"></i>
                        <a href="{{ url('/chat') }}" class="itens mostra2">
                            Chat
                        </a>
                    </li>
                    <li>
                        <i class="fas fa-info"></i>
                        <a href="{{ url('/justificativa') }}" class="itens mostra2">
                            Justificativa
                        </a>
                    </li>
                </ul>
            </ul>
            
        </div>
        <div id="tudo">
            @yield('direita')
        </div>
        
        
        
        <script src="{{asset('js/msg.js')}}"></script>
    </body>

    <script>
        
        $('#menu_lateral').mouseover(function() {
            menu_lateral.classList.remove("fechar_menu")
            menu_lateral.classList.add("expandir_menu")
            label_usuario.classList.add("aparecer")
            label_empresa.classList.add("aparecer")
            label_controle.classList.add("aparecer")
            $('#menu_lateral ul .itens').toggleClass('mostra2')
        })
        $('#menu_lateral').mouseout(function() {
            menu_lateral.classList.remove("expandir_menu")
            menu_lateral.classList.add("fechar_menu")
            label_usuario.classList.remove("aparecer")
            label_empresa.classList.remove("aparecer")
            label_controle.classList.remove("aparecer")
            $('#menu_lateral ul .itens').toggleClass('mostra2')
        })
        $('.usuario').click(function() {
            $('#menu_lateral ul .itens_usuario').toggleClass('mostra')
            $('#menu_lateral ul .seta1').toggleClass('gira')
            const div = document.querySelector('.itens_empresa')
            const div2 = document.querySelector('.itens_controle')
            if(div.classList.contains('mostra')) {
                $('#menu_lateral ul .itens_empresa').toggleClass('mostra')
                $('#menu_lateral ul .seta2').toggleClass('gira')
            }
            if(div2.classList.contains('mostra')) {
                $('#menu_lateral ul .itens_controle').toggleClass('mostra')
                $('#menu_lateral ul .seta3').toggleClass('gira')
            }
        })
        $('.empresa').click(function() {
            $('#menu_lateral ul .itens_empresa').toggleClass('mostra')
            $('#menu_lateral ul .seta2').toggleClass('gira')
            const div = document.querySelector('.itens_usuario')
            const div2 = document.querySelector('.itens_controle')
            if(div.classList.contains('mostra')) {
                $('#menu_lateral ul .itens_usuario').toggleClass('mostra')
                $('#menu_lateral ul .seta1').toggleClass('gira')
            }
            if(div2.classList.contains('mostra')) {
                $('#menu_lateral ul .itens_controle').toggleClass('mostra')
                $('#menu_lateral ul .seta3').toggleClass('gira')
            }
        })
        $('.controle').click(function() {
            $('#menu_lateral ul .itens_controle').toggleClass('mostra')
            $('#menu_lateral ul .seta3').toggleClass('gira')
            const div = document.querySelector('.itens_usuario')
            const div2 = document.querySelector('.itens_empresa')
            if(div.classList.contains('mostra')) {
                $('#menu_lateral ul .itens_usuario').toggleClass('mostra')
                $('#menu_lateral ul .seta1').toggleClass('gira')
            }
            if(div2.classList.contains('mostra')) {
                $('#menu_lateral ul .itens_empresa').toggleClass('mostra')
                $('#menu_lateral ul .seta2').toggleClass('gira')
            }
        })
     </script>
</html>

