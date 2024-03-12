<?php
    session_start();                        //inicia uma SESSÃO para que possa exibir exibir mensagem de erro ou cadastro concluido
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel ="stylesheet" type="text/css" href = "_css/cadastro_usu.css"/>
        <title>Jogo da Memória</title>
    </head>

    <body>
        <div id="interface">
            <header>
                <h1 id = "cabecalho" >Jogo da Memória</h1>
                <a href="index.php"> 
                <input type="button" id= "voltar" name="botao" value= "<"></a>
            </header>
            
            
            <section>
                <header id="cadastrar">
                    <h1>Cadastrar Usuário</h1>
                </header>
                <?php
                    if(isset($_SESSION['vazio_usu'])):            //se existir um status cadastro na sessão e for true então exibi mensagem de cadastro concluido
                ?>
                <div class="notification is-success" id="mensagem">
                    <p>Campo usuário em branco</p>
                </div>
                <?php
                    endif;
                    unset($_SESSION['vazio_usu']);                //apaga o status cadastro
                ?>
                <?php
                    if(isset($_SESSION['vazio_sen'])):            //se existir um status cadastro na sessão e for true então exibi mensagem de cadastro concluido
                ?>
                <div class="notification is-success" id="mensagem">
                <p>Campo senha em branco</p>
                </div>
                <?php
                    endif;
                    unset($_SESSION['vazio_sen']);                //apaga o status cadastro
                ?>
                <?php
                    if(isset($_SESSION['senha_exotica'])):            //se existir um status cadastro na sessão e for true então exibi mensagem de cadastro concluido
                ?>
                <div class="notification is-success" id="mensagem">
                    <p>A senha possui caracteres não permitidos (°¹²¨§ª etc.),<br/> tente outros caracteres</p>
                </div>
                <?php
                    endif;
                    unset($_SESSION['senha_exotica']);                //apaga o status cadastro
                ?>
                <?php
                    if(isset($_SESSION['status_cadastro'])):            //se existir um status cadastro na sessão e for true então exibi mensagem de cadastro concluido
                ?>
                <div class="notification is-success" id="mensagem">
                    <p>Cadastro efetuado!</p>
                    <p>Faça login informando o seu usuário e senha <a href="login.php">aqui</a></p>
                </div>
                <?php
                    endif;
                    unset($_SESSION['status_cadastro']);                //apaga o status cadastro
                ?>

                <?php
                    if(isset($_SESSION['usuario_existe'])):             //se existir um usuario existe e for true exibi mensagem de usuario ja cadastrado
                ?>
                <div class="notification is-info" id="mensagem">
                    <p>O usuário escolhido já existe. Informe outro e tente novamente.</p>
                </div>
                <?php
                    endif;
                    unset($_SESSION['usuario_existe']);                 //apaga o usuario existe
                ?>

                <?php
                    if(isset($_SESSION['senha_existe'])):               //se existir um senha existe e for true exibi mensagem de senha ja cadastrada
                ?>
                <div class="notification is-info" id="mensagem">
                    <p>A senha escolhida já existe. Informe outra e tente novamente.</p>
                </div>
                <?php
                    endif;
                    unset($_SESSION['senha_existe']);                   //apaga o senha existe
                ?>
                
                <form action="cadastrar.php" method="POST">         <!-- formulário que sera enviado para cadastrar.php  -->
                    <br/><br/>
                    Nome:
                    <?php if(isset($_GET['nome'])): ?>
                        <input type="text" id="nome" name="usuario" value="<?php echo $_GET['nome'];?>" pattern="^[a-zA-Z0-9]+$"/>
                    <?php endif; if(!isset($_GET['nome'])): ?>
                        <input type="text" id="nome" name="usuario" placeholder="Ex: Cláudio" pattern="^[a-zA-Z0-9]+$"/>
                    <?php endif; ?>
                    <p id="permi">*são permitidas apenas letras ou números</p>
                    <br/><br/>
                    Senha:
                    <input type="password" id="senha" name="senha" placeholder="ex: 1234"/><br/>
                    <br/><br/>
                    <button type="submit" id="enviar" name="botao">CADASTRAR</button>
                </form>

            </section>

            <footer id ="rodape">
                <p> Copyright &copy; 2020 - by <a href="https://www.linkedin.com/in/ester-toja-692a6566/"    target="_blank"> Ester Toja </a>| <a href="https://www.linkedin.com/in/igor-bandasz-864410167/" target="_blank"> Igor Bandasz </a>| <a href="https://www.linkedin.com/in/roberta-dias-182797140/" target="_blank"> Roberta Dias</a> </p>
            </footer>
        </div>
    </body>

</html>