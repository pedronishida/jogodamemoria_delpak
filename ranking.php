<?php
include('verifica_login.php');                          //Verifica se tem alguém logado 
include('conexao.php');                                 //Faz a conexão com o Banco de Dados e salva em $conexao

unset($_SESSION['pontos']);
unset($_SESSION['pontosanterior']);

function listar_ranking($recorde, $conexao){              //Função que traz o nome e o recorde de quem está 
                                                        //no ranking de acordo com o nivel de dificuldade
    $query="SELECT nome, $recorde from usuarios
    order by $recorde desc
    limit 10;";

    $resultado=mysqli_query($conexao,$query);           //chama o SELECT no Banco de Dados
    
    return $resultado;
}

$nivel=4;                                               //Inicializa o NIVEL caso a pessoa acesse o ranking através do menu
if(isset($_GET['nivel']))                               //Se vier depois do gameover ou selecionar um nivel diferente
    $nivel=$_GET['nivel'];                              //a variavel NIVEL recebe o que vier em $_GET

switch ($nivel){
    case 4:
        $recorde="rec_iniciante";break;
    case 6:
        $recorde="rec_moderado";break;
    case 8:
        $recorde="rec_intermediario";break;
    case 10:
        $recorde="rec_avancado";break;
    case 12:
        $recorde="rec_mestre";break;
}

$resultado=listar_ranking($recorde,$conexao);             //armazena o resultado do SELECT
$vetnome=[ ];                                           //inicializa o vetor que terá o nome de quem está no ranking    
$vetrec=[ ];                                            //inicializa o vetor que terá o recorde de quem está no ranking
$cont=0;                                                //inicializa o contador que será usado pra preencher com vazio caso haja menos de 10 pessoas no ranking 
    while($row=mysqli_fetch_array($resultado)) {        //salva em forma de array os resultados encontrados no SELECT
        $vetnome[$cont]=$row['nome'];
        $vetrec[$cont]=$row[$recorde];
        $cont++; 
    } 
                           
for($cont;$cont<10;$cont++){                            //Se houver menos de 10 pessoas no ranking preenche as posições restanntes com "vazio"
    $vetnome[$cont]="---";
    $vetrec[$cont]="---";
}

 ?> 

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jogo da Memória</title>
        <link rel ="stylesheet" type="text/css" href = "_css/ranking.css"/>
    </head>
    <body>
      
        <div id="interface">
            <header>
                <h1 id = "cabecalho" >Jogo da Memória</h1>
                <a href="menu.php"> 
                <input type="button" id= "voltar" name="botao" value= "<"></a>
            </header>

            <header id = "cabecalho-ranking">
                <h1>Ranking</h1>
            </header>
            <section class="box box--center"  >   
                <?php 
                    $links = [
                        "Iniciante" => 4,
                        "Moderado" => 6,
                        "Intermediário" => 8,
                        "Avançado" => 10,
                        "Mestre" => 12,
                     ];

                ?>
                <?php foreach( $links as $texto => $valor){ ?>
                    <a  class="opcao opcaolink" href="ranking.php?nivel=<?php echo $valor;?>"> 
                        <?php echo $texto;?>      
                    </a>
                <?php } ?>
            </section>
            <section class="box">
                <ul class="lista">

                    <li id="jogador" >
                        <img  src="_imagens/primeiro-ranking.png">
                        <span>
                            <b> 1 -> <?php echo $vetnome[0];?> </b>
                            <i>Pontuação:<?php echo $vetrec[0];?> </i>
                        </span>
                    </li>
                    <li id="jogador" >
                        <span>
                            <b> 6-> <?php echo $vetnome[5];?> </b>
                            <i>Pontuação:<?php echo $vetrec[5];?> </i>
                        </span>
                    </li>
                    <li id="jogador" >
                        <img  src="_imagens/podio-lugar.png"/>    
                        <span>
                            <b> 2-> <?php echo $vetnome[1];?> </b>
                            <i>Pontuação:<?php echo $vetrec[1];?> </i>
                        </span>
                    </li>
                    <li id="jogador" >
                        <span>
                            <b> 7-> <?php echo $vetnome[6];?> </b>
                            <i>Pontuação:<?php echo $vetrec[6];?> </i>
                        </span>
                    </li>
                    <li id="jogador" >
                        <img  src="_imagens/podio-lugar2.png"/>   
                        <span>
                            <b> 3-> <?php echo $vetnome[2];?> </b>
                            <i>Pontuação:<?php echo $vetrec[2];?> </i>
                        </span>
                    </li>
                    <li id="jogador" >
                        <span>
                            <b> 8-> <?php echo $vetnome[7];?> </b>
                            <i>Pontuação:<?php echo $vetrec[7];?> </i>
                        </span>
                    </li>
                    <li id="jogador" >
                        <span>
                            <b> 4-> <?php echo $vetnome[3];?> </b>
                            <i>Pontuação:<?php echo $vetrec[3]?> </i>
                        </span>
                    </li>
                    <li id="jogador" >
                        <span>
                            <b> 9-> <?php echo$vetnome[8];?> </b>
                            <i>Pontuação:<?php echo $vetrec[8]?> </i>
                        </span>
                    </li>
                    <li id="jogador" >
                        <span>
                            <b> 5-> <?php echo $vetnome[4];?> </b>
                            <i>Pontuação:<?php echo $vetrec[4]?> </i>
                        </span>
                    </li>
                    <li id="jogador" >
                        <span>
                            <b> 10-> <?php  echo $vetnome[9];?> </b>
                            <i>Pontuação:<?php echo$vetrec[9]?> </i>
                        </span>
                    </li>
                </ul>
            </section>

            <footer id ="rodape">
                <p> Copyright &copy; 2020 - by <a href="https://www.linkedin.com/in/ester-toja-692a6566/"    target="_blank"> Ester Toja </a> | <a href="https://www.linkedin.com/in/igor-bandasz-864410167/" target="_blank"> Igor Bandasz </a> | <a href="https://www.linkedin.com/in/roberta-dias-182797140/" target="_blank">Roberta Dias</a> </p>
            </footer>

        </div>
        <!--<script type="text/javascript" src="javascript.js"></script>-->
    </body>

</html>