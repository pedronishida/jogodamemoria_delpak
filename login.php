<?php
session_start();    //inicia uma SESSÃO para que possa exibir exibir mensagem de erro de login
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel ="stylesheet" type="text/css" href = "_css/login.css"/>
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
                <header id="login">
                    <h1>LOGIN</h1>
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
                    if(isset($_SESSION['nao_autenticado'])):            //Se em logar.php retornar $_SESSION['nao_autenticado']=true ira exibir a mansagem de usuario incorreto
                ?>                                                      
                <div class="notification is-danger" id="mensagem">
                      <p>ERRO: Usuário ou senha inválidos.</p>
                </div>
                <?php
                    endif;
                    unset($_SESSION['nao_autenticado']);
                ?>
                <form action="logar.php" method="POST">
                    <br></br>
                    Nome:
                    <?php if(isset($_GET['nome'])): ?>
                        <input type="text" id="nome_jogador" name="usuario" value="<?php echo $_GET['nome'];?>" />
                    <?php endif; if(!isset($_GET['nome'])): ?>
                        <input name="usuario" type="text" id="nome_jogador" placeholder="Cláudio" />
                    <?php endif; ?>
                    
                    <br></br>
                    Senha:
                    <input name="senha" type="password" id="senha_jogador"  placeholder="1234"/>
                    <br></br>
                    <button type="submit" id="enviar" name="botao">ENTRAR</button>
                </form>

            </section>

            <footer id ="rodape">
                <p> Copyright &copy; 2020 - by <a href="https://www.linkedin.com/in/ester-toja-692a6566/"    target="_blank"> Ester Toja </a>| <a href="https://www.linkedin.com/in/igor-bandasz-864410167/" target="_blank"> Igor Bandasz </a>| <a href="https://www.linkedin.com/in/roberta-dias-182797140/" target="_blank"> Roberta Dias</a> </p>
            </footer>
        </div>
    </body>

</html>