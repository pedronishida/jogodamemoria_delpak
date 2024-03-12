<?php
include('verifica_login.php');
unset($_SESSION['nivel']);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jogo da Memória</title> 
        <link rel ="stylesheet" type="text/css" href = "_css/escolher_nivel.css"/>       
    </head>

    <body>
        <div id="interface">
            <header>
                <h1 id = "cabecalho" >Jogo da Memória</h1>
                <a href="menu.php" > 
                <input type="button" id= "voltar" name="botao" value= "<">
                </a>
            </header>

            <header id = "cabecalho-tema">
                <h1>Escolha Nível:</h1>
            </header>
            <form action="jogo.php" method="post">
                <ul id="itens-nivel">
                    <li id="opcao"> 
                        <a href="jogo.php"  target="_self"> 
                            <button id="descricao" name="nivel" value="4">Iniciante</button>   
                        </a> 
                    </li>  
                    <li id="opcao">
                        <a href="jogo.php"  target="_self"> 
                            <button id="descricao" name="nivel" value="6">Moderado</button>   
                        </a> 
                    </li>
                    <li id="opcao">
                        <a href="jogo.php"  target="_self"> 
                            <button id="descricao" name="nivel" value="8">Intermediário</button>  
                        </a> 
                    </li>  
                    <li id="opcao">
                        <a href="jogo.php" target="_self"> 
                            <button id="descricao" name="nivel" value="10">Avançado</button> 
                        </a> 
                    </li>
                    <li id="opcao">
                        <a href="jogo.php"  target="_self"> 
                            <button id="descricao" name="nivel" value="12">Mestre</button> 
                        </a>
                    </li>
                </ul>
            </form>
            <footer id ="rodape">
                 <p> Copyright &copy; 2020 - by <a href="https://www.linkedin.com/in/ester-toja-692a6566/"    target="_blank"> Ester Toja </a> | <a href="https://www.linkedin.com/in/igor-bandasz-864410167/" target="_blank"> Igor Bandasz </a> | <a href="https://www.linkedin.com/in/roberta-dias-182797140/" target="_blank">Roberta Dias</a> </p>
            </footer>
        </div>
    </body>

</html>
