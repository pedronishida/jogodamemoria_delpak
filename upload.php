<?php
    include('verifica_login.php');
    include('conexao.php');


    $diretorio = "_imagens/";

  $nome=$_POST['nome'];
  $id=$_POST['id'];
  $_FILES['carta']['name']=$nome;

  $caminho = localizacao($diretorio, $_FILES['carta']['name']);

  $uploadOk = 1;

  $tipo_arquivo=tipo_arquivo($caminho);
    //Checa se foi selecionado um arquivo
  if(empty($_FILES['carta']['tmp_name'])){
      $_SESSION['vazio']=true;
      header('Location: cadastrar_cartas.php?id='.$id);
      exit;
  }

    // Checa se de fato é uma imagem
  if(!eh_imagem($_FILES['carta']['tmp_name']))
    $uploadOk = 0;   

    // Checa se já existe o arquivo
  if(!ja_existe($caminho))
    $uploadOk = 0;
  
    // Checa se o arquivo é grande
  if(!eh_grande($_FILES['carta']['size']))  
    $uploadOk = 0;
    

    // Checa se é uma imagem .jpg
  if(!eh_jpg($tipo_arquivo))  
    $uploadOk = 0;
      
    // Checa se algum dos teste anteriores deu errado
  if ($uploadOk == 0) {
    header('Location: cadastrar_cartas.php?id='.$id);
    // Se deu tudo certo então tenta fazer o upload 
  } else {
    $subiu=fazer_upload($_FILES['carta']['tmp_name'],$caminho);
  }

  if($subiu){
    $query="INSERT into cartas (nome, idtema) values ('$nome','$id')";
    if($conexao->query($query) === TRUE) {
      header('Location: /cadastrar_cartas.php?id='.$id); 
    }else{
      echo "não fez upload";
    }
  }
  
  