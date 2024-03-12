<?php
include('verifica_login.php');
include('conexao.php');


$id=isset($_GET['id']) ? $_GET['id'] : false;
if(!$id){
    // fazer essa parte
    echo "isso não devia acontecer";
    exit;
}

$query="SELECT nome from temas where idtema=$id limit 1 ";
$result=$conexao->query($query);
$row=$result->fetch_row();
$tema=$row[0];
if(!$tema){
    exit;
}

$query="SELECT nome from cartas where idtema=$id limit 13";
$cartas=selectVarios($conexao,$query);

$quant=count($cartas);

if($quant>=13){
    $val=1;
    $query="UPDATE temas set disp='1' where idtema='$id' ";
    $result=$conexao->query($query);
    header('Location: /menu_adm.php?terminou='.$val);
}

$capa=$quant==12 ? 1 : 0;
$nome_carta=$capa ? "capa".$id.".jpg" : $tema.$quant.".jpg" ;

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel ="stylesheet" type="text/css" href = "_css/cadastrar_cartas.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jogo da Memória</title>
    </head>
    <body>
        <div id="interface">
            <header>
                <h1 id = "cabecalho" >Jogo da Memória</h1>
                <a href="cadastrar_tema_das_cartas.php"> 
                <input type="button" id= "voltar" name="botao" value= "<">
                </a>
            </header>
            <header id="cabecalho-manter-cartas" >
                <h1> Adicionar Carta ao tema: <?php echo $tema; ?> </h1>
            </header>
            <?php
                if(isset($_SESSION['vazio'])):            
            ?>                                                      
            <div class="notification is-danger" id="mensagem">
                  <p>ERRO: Nenhuma imagem selecionada.</p>
            </div>
            <?php
                endif;
                unset($_SESSION['vazio']);
            ?>
            <?php
                if(isset($_SESSION['naoimagem'])):            
            ?>                                                      
            <div class="notification is-danger" id="mensagem">
                  <p>ERRO: O arquivo não é uma imagem.</p>
            </div>
            <?php
                endif;
                unset($_SESSION['naoimagem']);
            ?>
            <?php
                    if(isset($_SESSION['existe'])):            
            ?>                                                      
            <div class="notification is-danger" id="mensagem">
                  <p>ERRO: O arquivo já existente.</p>
            </div>
            <?php
                endif;
                unset($_SESSION['existe']);
            ?>
            <?php
                if(isset($_SESSION['grande'])):            
            ?>                                                      
            <div class="notification is-danger" id="mensagem">
                  <p>ERRO: O arquivo é muito grande.</p>
            </div>
            <?php
                endif;
                unset($_SESSION['grande']);
            ?>
            <?php
                if(isset($_SESSION['tipodiferente'])):            
            ?>                                                      
            <div class="notification is-danger" id="mensagem">
                  <p>ERRO: Somente são aceitas imagens .jpg</p>
            </div>
            <?php
                endif;
                unset($_SESSION['tipodiferente']);
            ?>
            <?php
                if(isset($_SESSION['deuruimupload'])):            
            ?>                                                      
            <div class="notification is-danger" id="mensagem">
                  <p>ERRO: houve um problema como upload.</p>
            </div>
            <?php
                endif;
                unset($_SESSION['deuruimupload']);
            ?>

            <section>
                <?php if($quant<=13){ ?>

                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <?php if($capa): ?>
                            <p id="carta">Capa :</p>
                        <?php else: ?>
                            <p id="carta">Carta <?php echo $quant+1;?>:</p>
                        <?php endif; ?>
                        <br/> <p id="exemplo">(preferencialmente um retângulo na vertical)</p>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="nome" value="<?php echo $nome_carta;?>">
            
                        <input type="file" name="carta" id="carta">
                        <input type="submit" value="Fazer Upload" name="submit" id="submit">
                    </form>

                <?php }else{ ?>

                    <h1>já há cartas suficientes</h1>

                <?php } ?>
                <p id="enviadas">Cartas já enviadas:</p>
                <?php foreach($cartas as $v): ?>
                    <img src="_imagens/<?php echo $v['nome']; ?>" >
                <?php  endforeach; ?>

            </section>
            <footer id ="rodape">
                <p> Copyright &copy; 2020 - by <a href="https://www.linkedin.com/in/ester-toja-692a6566/"    target="_blank"> Ester Toja </a>| <a href="https://www.linkedin.com/in/igor-bandasz-864410167/" target="_blank"> Igor Bandasz </a>| <a href="https://www.linkedin.com/in/roberta-dias-182797140/" target="_blank"> Roberta Dias</a> </p>
            </footer>
        </div>
    </body>
</html>