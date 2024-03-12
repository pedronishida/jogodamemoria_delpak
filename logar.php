<?php
session_start();											//Inicia uma sessão
include('conexao.php');										//Traz a conexão com o Banco de Dados

if(empty($_POST['usuario'])) {  //Se o usuario não for preenchido então volta para a tela de login
    $_SESSION['vazio_usu']=true;
    header('Location: /login.php');
    exit();
}
if(empty($_POST['senha'])) {    //Se a senha não for preenchido então volta para a tela de login
	$_SESSION['vazio_sen']=true;
	$nome=$_POST['usuario'];
    header('Location: /login.php?nome='.$nome);
    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);	//formata as variaveis pra não dar erro ao fazer comando
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

if($usuario=="admin" && $senha=="admin"){					//se o usuario for o administrador redireciona pra area administrativa
	$_SESSION['usuario']=$usuario;
	header('Location: menu_adm.php');
	exit();
}

$query = "SELECT * from usuarios where nome = '$usuario' and senha = md5('$senha');";	//comando que será enviado para o Banco de Dados

$resultado = mysqli_query($conexao, $query);				//salva o retorno do comando enviado ao Banco de Dados

$row = mysqli_num_rows($resultado);							//conta quantos registros foram encontrados

if($row == 1) {												//se houver 1 registro então a SESSÃO recebe os dados do Usuario
	$_SESSION['usuario'] = $usuario;
	header('Location: menu.php');							//depois redireciona para o Menu do Jogo
	exit();
} else {													//senão tiver 1 registro retornado então volta para tela de login
	$_SESSION['nao_autenticado'] = true;					//a sessão recebe que não houve login para que seja exibida uma mensagem
	header('Location: login.php');
	exit();
}