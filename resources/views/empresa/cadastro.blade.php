<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>cadastrar</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="{{ asset('css/user_e_empresa/cadastro_e_login.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
        
        <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@vsilva472/jquery-viacep/dist/jquery-viacep.min.js"></script>
        <script src="<?php echo asset('js/jquery.maskedinput-1.1.4.pack.js')?>" type="text/javascript"></script>
        <script src="<?php echo asset('js/funcs_cad_empresa.js')?>"></script> 
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
            width: 50vw;
            min-height: 70vh;
            padding: 2rem;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 20px;
            margin: 1rem;
        }
        #header {
            display: flex;
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
        .label-float{
            position: relative;
            padding-top: 13px;
        }

        .label-float input{
            border: 1px solid lightgrey;
            border-radius: 5px;
            outline: none;
            padding: 12px 15px;
            font-size: 18px;
            transition: all .1s linear;
            -webkit-transition: all .1s linear;
            -moz-transition: all .1s linear;
            -webkit-appearance:none;
            font-weight: 200;
            background: #212529;
        }

        .label-float input:focus{
            border: 2px solid #3951b2;
        }

        .label-float input::placeholder{
            color:transparent;
        }

        .label-float label{
            pointer-events: none;
            position: absolute;
            top: calc(50% - 8px);
            left: 15px;
            transition: all .1s linear;
            -webkit-transition: all .1s linear;
            -moz-transition: all .1s linear;
            background-color: white;
            padding: 3px;
            box-sizing: border-box;
            font-weight: 400;
            background: #212529;
        }

        
        .label-float input:focus + label,
        .label-float input:not(:placeholder-shown) + label{
            font-size: 15px;
            top: 0;
            color: #FFF;
        }
        .filled {
            display: flex;
        }
        .input-longo input {
            width: 100%;
        }
        .input-setenta {
            width: 75%;
        }
        .input-vinte {
            width: 25%;
        }
        .input-cinquenta {
            width: 50%;
        }
        .input-trinta {
            width: 33%;
        }
        #cep, #uf, #cidade, #bairro, #endereco , #num, #compl, #senha, #senha2{
            width: 100%;
        }
        .fas, .fa-eye, .ver{
            margin: 3px 7px;
            background: #212529;
        }
        </style>
    </head>

    <body>
        <main class="container">
        <div id="header">
            <div><h2>Cadastro</h2></div>
            <div id="voltar">
                <a href="{{ url('/') }}">VOLTAR</a>
            </div>
        </div>
            <form action="{{ url('/cadastro_empresa')}}" method="post"  enctype="multipart/form-data" data-viacep>
                {{ csrf_field() }}
                <div class="etapas">
                    <h4 style="color: rgb(95, 185, 151);">Empresa</h4>
                    <img src="{{ url('/imgs/cad_empresa/seta.png') }}" alt="Logo Simplify"  width="70px">
                    <h4>Administrador</h4>
                </div>
                
                <div class="label-float input-longo">
                    <input type="text" name="nome" placeholder="NOME:" value="{{ $empresa->nome ?? old('nome') }}" required>
                    <label>NOME</label>
                </div>
                <div class="label-float input-longo">
                    <input type="text" name="cnpj" id="cnpj" placeholder="CNPJ:" value="{{$empresa->cnpj ?? old('cnpj') }}" required>
                    <label>CNPJ</label>
                </div>

                <div class="filled">
                    <div class="label-float input-setenta">
                        <input type="text" name="cep" data-viacep-cep placeholder="CEP:" id="cep" value="{{ $empresa->cep ?? old('cep') }}" required>
                        <label>CEP</label>
                    </div>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <div class="label-float input-vinte">
                        <input type="text" name="estado" data-viacep-estado placeholder="ESTADO:" id="uf" value="{{ $empresa->estado ?? old('estado') }}" required>
                        <label>ESTADO</label>
                    </div>
                </div>

                <div class="filled">
                    <div class="label-float input-cinquenta">
                        <input type="text" name="cidade" id="cidade" data-viacep-cidade placeholder="CIDADE:" value="{{ $empresa->cidade ?? old('cidade') }}" required>
                        <label>CIDADE</label>
                    </div>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <div class="label-float input-cinquenta">
                        <input type="text" name="bairro" id="bairro" data-viacep-bairro placeholder="BAIRRO:" value="{{ $empresa->bairro ?? old('bairro') }}" required>
                        <label>BAIRRO</label>
                    </div>
                </div>

                <div class="filled">
                    <div class="label-float input-trinta">
                        <input type="text" name="rua" id="endereco" data-viacep-endereco placeholder="RUA:" value="{{ $empresa->rua ?? old('rua') }}" required>
                        <label>RUA</label>
                    </div>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <div class="label-float input-trinta">
                        <input type="text" id="num" name="numero" placeholder="N°:" value="{{ $empresa->numero ?? old('numero') }}" required>
                        <label>NÚMERO</label>
                    </div>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <div class="label-float input-trinta">
                        <input type="text" id="compl" name="complemento" placeholder="COMPLEMENTO:" value="{{ $empresa->complemento ?? old('complemento') }}">
                        <label>COMPLEMENTO</label>
                    </div>
                </div>

                <div class="filled">
                    <div class="label-float input-cinquenta">
                        <input type="password" id="senha" name="senha" placeholder="SENHA DA EMPRESA" value="{{ $empresa->senha ?? old('senha') }}" required>
                        <label>SENHA DA EMPRESA</label>
                    </div>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <div class="label-float input-cinquenta">
                        <input type="password" id="senha2" name="confirma_senha" placeholder="CONFIRMAR SENHA:" value="{{ $empresa->confirma_senha ?? old('confirma_senha')   }}" required>
                        <label>CONFIRMAR SENHA</label>
                    </div>
                </div>
                <div class="filled">
                    <div class="input-cinquenta">
                        <button type="button" onclick="mostrarSenha()" class="ver"><i id="botao" class="fas fa-eye"></i></button>
                    </div>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <div class="input-cinquenta">
                        <button type="button" onclick="mostrarSenha2()" class="ver"><i id="botao2" class="fas fa-eye"></i></button>
                    </div>
                </div>
                <div id="botao">
                    <input type="submit" name="botao" value="Continuar" class="btn-enviar">
                </div>
            </form>
        </div>

        <script>
            $('#form').on( 'viacep.ajax.complete', function () {
                // remover o header para esta requisicao
                delete $.ajaxSettings.headers["X-CSRF-TOKEN"];
                var $this = $( this ), fields_to_block = ['cep', 'rua', 'bairro', 'cidade', 'estado'];

                fields_to_block.forEach(function (name) {
                    $this.find('[name="' + name + '"]').attr('disabled', true);
                });
            }).on('viacep.ajax.complete', function () {
                document.getElementById("#num").focus();
                // readicionar o header para outras requisições internas ao projeto.
                $.ajaxSettings.headers["X-CSRF-TOKEN"] = $('meta[name="csrf-token"]').attr('content');
            });
        </script>
   
    </body>

</html>



    
