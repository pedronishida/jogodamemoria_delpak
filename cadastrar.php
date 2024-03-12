<?php
session_start();										//inicia a sessão para enviar uma mensagem para cadastro_usu.php
include("conexao.php");

if(empty($_POST['usuario'])) {  //Se o usuario não for preenchido então volta para a tela de login
    $_SESSION['vazio_usu']=true;
    header('Location: /cadastro_usu.php');
    exit();
}
if(empty($_POST['senha'])) {    //Se a senha não for preenchido então volta para a tela de login
	$_SESSION['vazio_sen']=true;
	$nome=$_POST['usuario'];
    header('Location: /cadastro_usu.php?nome='.$nome);
    exit();
}

if(!preg_match("^[A-Za-z0-9$!@#%&*()-_=+<>;?/|]+$^",$_POST['senha'])){
    $_SESSION['senha_exotica']=true;
	$nome=$_POST['usuario'];
    header('Location: /cadastro_usu.php?nome='.$nome);
    exit();    
}

$usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
$senha = mysqli_real_escape_string($conexao, trim(md5($_POST['senha'])));



$sql = "SELECT count(*) as total from usuarios where nome = '$usuario'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1) {
	$_SESSION['usuario_existe'] = true;
	header('Location: /cadastro_usu.php');
	exit;
}

$sql = "SELECT count(*) as total from usuarios where senha = '$senha'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1) {
	$_SESSION['senha_existe'] = true;
	$nome=$_POST['usuario'];
    header('Location: /cadastro_usu.php?nome='.$nome);
	exit;
}

$sql = "INSERT INTO usuarios (nome, senha) VALUES ('$usuario', '$senha');";

if($conexao->query($sql) === TRUE) {
	$_SESSION['status_cadastro'] = true;
}

$conexao->close();

header('Location: /cadastro_usu.php');
exit;
?>