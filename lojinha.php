<?php
include('verifica_login.php');
include('conexao.php');

$usuario=$_SESSION['usuario'];


$query="SELECT bonusrevelar from usuarios where nome='$usuario'";
$bonus_revelar=selectUm($conexao,$query);

$query="SELECT bonusexcluir from usuarios where nome='$usuario'";
$bonus_excluir=selectUm($conexao,$query);

$query="SELECT dinheiro from usuarios where nome='$usuario'";
$dinheiro_banco=selectUm($conexao,$query);



?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jogo da Memória</title>
        <link rel ="stylesheet" type="text/css" href = "_css/lojinha.css"/>
    </head>
    <body>
        <div id="interface">
            <header>
                <h1 id = "cabecalho" >Jogo da Memória</h1>
                <a href="menu.php"> 
                <input type="button" id= "voltar" name="botao" value= "<">
                </a>
            </header>

            <header id="cabecalho-lojinha">
                <h1> Lojinha </h1> 
                <h2> Você possui: </h2>
                <p id="qtd-dinheiro"><?php echo $dinheiro_banco;?></p> 
            </header>

            <section id="bonus">
                <h2 id="revelar">Bonus Revelar: </h2>
                <p id="revelar"><?php echo $bonus_revelar; ?></p>
                
                <h2 id="excluir">Bonus Excluir: </h2>
                <p id="excluir"><?php echo $bonus_excluir; ?></p>  
            </section>

            <?php
                if(isset($_SESSION['tinhadinheiro'])):
            ?>
            <div class="notification is-success" id="mensagem">
                <h1> Compra efetuada com Sucesso !!!</h1>
            </div>
            <?php
                endif;
                unset($_SESSION['tinhadinheiro']);
            ?>

            <?php
                if(isset($_SESSION['semdinheiro'])):
            ?>
            <div class="notification is-success" id="mensagem">
                <h1>Faltou Dinheiro :( </h1>
                <p> Para adquirir mais dinheiro jogue outra vez!</p>
            </div>
            <?php
                endif;
                unset($_SESSION['semdinheiro']);
            ?>

           <section  class="opcao">
                <form class="formulario" action="comprar1.php" method="POST">
                    <img src="_imagens/beneficio-tempo.png"/> 
                    <h2 class="text"> Revela  </h2> <br/>
                    <h3 class="valor"> Custa = 1000 pontos </h3> <br/>
                    <p class="descricao"> Clica em uma carta e revela a outra carta. </p><br/>
                    <input type="range" name="vol" value="0" min="0" max="10" oninput="display.value=value" onchange="display.value=value"> 
                    <input type="text" id="display" class="display" value="0" readonly>  
                    </br> 
                    <button class="buttom" value="comprar">COMPRAR</button>
                </form>
                <form  class="formulario" action="comprar2.php" method="POST">
                    <img src="_imagens/beneficio-exclui.png"/>
                    <h2 class="text"> Excluir  </h2> <br/>
                    <h3 class="valor"> Custa = 2000 pontos </h3> <br/>
                    <p class="descricao"> Exclui um par de cartas do jogo. </p><br/>
                    <input type="range" name="vol" value="0" min="0" max="10"     oninput="display.value=value" onchange="display.value=value"> 
                    <input type="text" id="display" class="display" value="0" readonly>
                    </br>  
                    <button class="buttom" value="comprar">COMPRAR</button>
                </form>
            </section>
            <footer id ="rodape">
                <p> Copyright &copy; 2020 - by <a href="https://www.linkedin.com/in/ester-toja-692a6566/"    target="_blank"> Ester Toja </a>| 
                                               <a href="https://www.linkedin.com/in/igor-bandasz-864410167/" target="_blank"> Igor Bandasz </a>| 
                                               <a href="https://www.linkedin.com/in/roberta-dias-182797140/" target="_blank">Roberta Dias</a> </p>
            </footer>

        </div>
    </body>

</html>