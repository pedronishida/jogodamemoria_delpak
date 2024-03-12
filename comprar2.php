<?php
    include ('verifica_login.php');
    include ('conexao.php');
    
    $usuario = $_SESSION['usuario'];

    $query="SELECT bonusexcluir from usuarios where nome='$usuario'";
    $bonus=selectUm($conexao,$query);
    
    $query="SELECT dinheiro from usuarios where nome='$usuario'";
    $dinheiro_banco=selectUm($conexao,$query);

    $beneficio=$_POST['vol'];
    $valor=$beneficio*2000;

    $dinheiro_banco=$dinheiro_banco-$valor;
    $dinheiro=$dinheiro_banco;
    if($beneficio>0 && $dinheiro_banco>=0)
    {
        
        $bonus=$bonus+$beneficio;
        $query="UPDATE  usuarios 
        set bonusexcluir='$bonus'
        where nome='$usuario';";

        if($result=mysqli_query($conexao,$query) ===true){
            $query="UPDATE  usuarios 
            set dinheiro='$dinheiro'
            where nome='$usuario';";
            
            if($result=mysqli_query($conexao,$query) ===true){
                $_SESSION['tinhadinheiro']=true;
                header('Location: /lojinha.php');
                exit;
            }
        }
    }else if($beneficio==0){
        header('Location: /lojinha.php');
        exit;
    }else{
        $_SESSION['semdinheiro']=true;
        header('Location: /lojinha.php');
        exit;
    }
