<?php
include('verifica_login.php');
include('conexao.php');

$erro=false;
if(isset($_POST['tema']) && !empty($_POST['tema'])){
   
    $query="INSERT into temas (nome) values ('". $_POST['tema'] ."')";
    $conexao->query($query);
    if(!$conexao->error){
        $id=$conexao->insert_id;
        header('Location: /cadastrar_cartas.php?id='.$id);
    }
    $erro=true;

}
    if(isset($_POST['tema']) && empty($_POST['tema'])){
        $_SESSION['vazio']=true;
    }


?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel ="stylesheet" type="text/css" href = "_css/cadastrar_tema_das_cartas.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jogo da Memória</title>
    </head>
    <body>
        <div id="interface">
            <header>
                <h1 id = "cabecalho" >Jogo da Memória</h1>
                <a href="menu_adm.php" > 
                <input type="button" id= "voltar" name="botao" value= "<">
                </a>
            </header>

            <header id="cabecalho-cadastrar-tema">
                <h1> Cadastrar tema das cartas </h1>
            </header>

            <?php if($erro):?>
                <div id="mensagem">
                    <h1>Esse nome de tema já foi utilizado</h1>
                </div>
            <?php endif;?>
            
            <?php
                if(isset($_SESSION['vazio'])):            //se existir um status cadastro na sessão e for true então exibi mensagem de cadastro concluido
            ?>
            <div class="notification is-success" id="mensagem">
                <p>O nome do tema está em branco</p>
            </div>
            <?php
                endif;
                unset($_SESSION['vazio']);                //apaga o status cadastro
            ?>

            <section>
                <form action="cadastrar_tema_das_cartas.php" method="POST">
                    <h1>Nome do Tema:</h1>
                    <input type="text" id="nome-tema" name="tema"/>
                
                    <input type="submit" id="salvar" name="botao" value="SEGUINTE">
                </form>
            </section>
            <footer id ="rodape">
                <p> Copyright &copy; 2020 - by <a href="https://www.linkedin.com/in/ester-toja-692a6566/"    target="_blank"> Ester Toja </a>| <a href="https://www.linkedin.com/in/igor-bandasz-864410167/" target="_blank"> Igor Bandasz </a>| <a href="https://www.linkedin.com/in/roberta-dias-182797140/" target="_blank"> Roberta Dias</a> </p>
            </footer>
        </div>
    </body>
</html>