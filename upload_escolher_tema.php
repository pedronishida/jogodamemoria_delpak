<?php
include('verifica_login.php');
include('conexao.php');

$user=$_SESSION['usuario'];
$tema=$_POST['tema'];

$query="UPDATE  usuarios 
set idtema='$tema'
where nome='$user';";

if($result=mysqli_query($conexao,$query) ===true){
    $_SESSION['tema_alterado']=true;
    header('Location: /menu.php');
    exit;
}else{
    $_SESSION['tema_nao_alterado']=true;
    header('Location: /escolher_tema.php');
    exit;
}
