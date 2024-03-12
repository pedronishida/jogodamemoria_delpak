<?php
include('conexao.php');
include('verifica_login.php');

$query="SELECT nome,idtema from temas where disp='1';";
$resultado=mysqli_query($conexao,$query);
$vetor_temas=[ ];
$vetor_id=[ ];
$cont=0;
while($temas=mysqli_fetch_array($resultado)){
    $vetor_temas[$cont]=$temas['nome'];
    $vetor_id[$cont]=$temas['idtema'];
    $cont++;
}
// dados vindo do banco
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jogo da Memória</title>    
        <link rel="stylesheet" type="text/css" href="_css/escolher_tema.css?v=<?php echo date("h:i:s")?>"/>
    </head>
    <body>
        <div id="interface">
            <header>
                <h1 id = "cabecalho" >Jogo da Memória</h1>
                <a href="menu.php" > 
                <input type="button" id= "voltar" name="botao" value= "<">
                </a>
            </header>

            <header id="cabecalho-tema" class="header">
                <h1>Escolha o Tema</h1>
            </header>
            <?php
                if(isset($_SESSION['tema_nao_alterado'])):            //se existir um tema_nao_alterado na sessão e for true então exibi mensagem de cadastro    concluido
            ?>
            <div id="mensagem" class="notification is-success">
             <h1>!!FALHA AO ALTERAR!!</h1>
            </div>
            <?php
                endif;
                unset($_SESSION['tema_nao_alterado']);                //apaga o tema_nao_alterado
            ?>
           
                 <form action="upload_escolher_tema.php" method="POST"> <!-- Documento e o metodo onda é mandado os dados-->
                <p class="lista_temas">
                    <?php for($i=0; $i<$cont;$i++) { ?> <!-- Dinamicamente muda os temas de acordo com o que vem do banco de dados-->
                        <label class="container"  id="i<?php echo $vetor_temas[$i]; ?>"> 
                        <input type="radio" name="tema" 
                        value="<?php echo $vetor_id[$i]; ?>"/> 
                        <span class="checkmark"> </span>
                        <img src="_imagens/capa<?php echo $vetor_id[$i];?>.jpg" alt=""> </label>
                    <?php } ?> 
                </p>
                <button class="button" value="Salvar!">Salvar</button>
            </form>
       
            <footer id ="rodape">
                 <p> Copyright &copy; 2020 - by <a href="https://www.linkedin.com/in/ester-toja-692a6566/"    target="_blank"> Ester Toja </a> | <a href="https://www.linkedin.com/in/igor-bandasz-864410167/" target="_blank"> Igor Bandasz </a> | <a href="https://www.linkedin.com/in/roberta-dias-182797140/" target="_blank">Roberta Dias</a> </p>
            </footer>
        </div>
    </body>

</html>
