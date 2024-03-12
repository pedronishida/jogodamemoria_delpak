<?php
include('verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel ="stylesheet" type="text/css" href = "_css/menu_adm.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jogo da Memória</title>
    </head>
    <body>
        <div id="interface">
            <header id = "cabecalho">
                <h1>Jogo da Memória</h1>
            </header>
            <section>
                <header id = "titulo">                    
                    <h1>MENU ADM</h1>
                </header>
                <?php if(isset($_GET['terminou'])): ?>
                    <div class="notification is-danger" id="mensagem">
                        <h1>Tema cadastrado com sucesso</h1>
                    </div>
                <?php endif; unset($_GET['terminou']);?>
                <div class="menu">
                    <a href="cadastrar_tema_das_cartas.php"  target="_self"> 
                        <button class = "opcao1" >ADICIONAR TEMA E CARTAS</button>
                   </a>
                    <a href="logout.php"  target="_self"> 
                        <button id="sair" class ="opcao2">SAIR</button>
                    </a>
                </div>
            </section>
            <footer id ="rodape">
                <p> Copyright &copy; 2020 - by <a href="https://www.linkedin.com/in/ester-toja-692a6566/"    target="_blank"> Ester Toja </a>| <a href="https://www.linkedin.com/in/igor-bandasz-864410167/" target="_blank"> Igor Bandasz </a>| <a href="https://www.linkedin.com/in/roberta-dias-182797140/" target="_blank"> Roberta Dias</a> </p>
            </footer>
        </div>
    </body>
</html>