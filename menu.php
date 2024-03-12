<?php
include('verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jogo da Memória</title>
        <link rel ="stylesheet" type="text/css" href = "_css/menu.css"/>
    </head>
    <body>
        <div id="interface">
            <header id = "cabecalho">
                    <h1>Jogo da Memória</h1>
            </header>
            <section>
                <header id="cabecalho-menu">                    
                    <h1 >MENU</h1>
                </header>
                <?php
                    if(isset($_SESSION['tema_alterado'])):            //Se em logar.php retornar $_SESSION['nao_autenticado']=true ira exibir a mansagem de usuario incorreto
                ?>                                                      
                <div class="notification is-danger" id="mensagem">
                      <p>Tema alterado com sucesso</p>
                </div>
                <?php
                    endif;
                    unset($_SESSION['tema_alterado']);
                ?>
                    <ul id="itens-menu">
                        <li id="opcao"> <a href="escolher_nivel.php" id="t1" target="_self"> <input type="button" name="botao" id="descricao" value="JOGAR"/></a><br/></li>
                        <br/>
                        <li id="opcao"> <a href="ranking.php" id="t2" target="_self"> <input type="button" name="botao" id="descricao" value="RANKING"/> </a><br/></li>
                        <br/>
                        <li id="opcao"> <a href="lojinha.php" id="t3" target="_self"> <input type="button" name="botao"  id="descricao" value= "LOJINHA"/></a><br/></li>
                        <br/>
                        <li id="opcao"> <a href="escolher_tema.php" id="t4" target="_self"> <input type="button" name="botao" id="descricao" value="ESCOLHER TEMA"/> </a><br/></li>
                        <br/>
                        <li id="opcao"> <a href="logout.php" id="t5" target="_self"> <input type="button" name="botao" id="descricao" value="SAIR"/></a><br/></li>
                    </ul>
            </section>

            <footer id ="rodape">
                <p> Copyright &copy; 2020 - by <a href="https://www.linkedin.com/in/ester-toja-692a6566/"    target="_blank"> Ester Toja </a>| <a href="https://www.linkedin.com/in/igor-bandasz-864410167/" target="_blank"> Igor Bandasz </a>| <a href="https://www.linkedin.com/in/roberta-dias-182797140/" target="_blank"> Roberta Dias</a> </p>
            </footer>
        </div>
    </body>

</html>