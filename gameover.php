<?php
    include('verifica_login.php');
    include('conexao.php');

    $pontos=$_GET['score'];
    echo json_encode(['passei_gameover']);
    $b2=$_GET['b1'];
    $b1=$_GET['b2'];

   
    if(isset($_SESSION['pontosanterior'])){
        $dinheirinho=$pontos - $_SESSION['pontosanterior'];
        $_SESSION['pontosanterior']=$pontos;
    }else{
        $_SESSION['pontosanterior']=$pontos;
        $dinheirinho=$pontos;
    }
    $usuario=$_SESSION['usuario'];

    $query="SELECT dinheiro from usuarios where nome='$usuario'";
    $dinheiro_banco=selectUm($conexao,$query);

    $dinheirinho=$dinheiro_banco + $dinheirinho;

    $_SESSION['pontos']=$pontos;
    $_SESSION['bonusrevelar']=$b1;
    $_SESSION['bonusexcluir']=$b2;

    

    $query="UPDATE usuarios set bonusrevelar='$b1', bonusexcluir='$b2', dinheiro='$dinheirinho' where nome='$usuario'";
    $result=mysqli_query($conexao,$query);

    $nivel=$_SESSION['nivel'];
    switch ($nivel){
        case 4:
            $recorde="rec_iniciante"; break;
        case 6:
            $recorde="rec_moderado"; break;
        case 8:
            $recorde="rec_intermediario"; break;
        case 10:
            $recorde="rec_avancado"; break;
        case 12:
            $recorde="rec_mestre"; break;
    
    }

    $query="SELECT $recorde from usuarios where nome='$usuario' limit 1";
    $result=mysqli_query($conexao,$query);
    while($retorno=mysqli_fetch_array($result)){
        $rec_atual=$retorno[$recorde];
    }

    if($pontos > $rec_atual){
        $query="UPDATE usuarios set $recorde ='$pontos' where nome='$usuario'";
        $result=mysqli_query($conexao,$query);
        $_SESSION[$recorde]=$pontos;
    }
