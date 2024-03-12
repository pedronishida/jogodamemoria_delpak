<?php
$conexao= mysqli_connect('localhost', 'id13837511_root', 'S5qmbY?W5)PzJUs7', 'id13837511_jogo') or die ('Não foi possível conectar');

function selectUm($conexao,$query){ 
    $result=$conexao->query($query);
    $row=$result->fetch_row();
    $resposta=$row[0];
    return $resposta;
}

function selectVarios($conexao,$query){
    $result=$conexao->query($query);
    $row=$result->fetch_all(MYSQLI_ASSOC);
    return $row;
}

function  localizacao($diretorio, $carta){
    $caminho=$diretorio . basename($carta);
    return $caminho;
}

function tipo_arquivo($caminho){
    $tipo_arquivo = strtolower(pathinfo($caminho,PATHINFO_EXTENSION));
    return $tipo_arquivo;
}

function eh_imagem($carta){
    $conferir=getimagesize($carta);
    if($conferir !== false){
        return 1;
    }else{
        $_SESSION['naoimagem']=true;
        return 0;
    }
}

function ja_existe($caminho){
    
    if(file_exists($caminho)){
        $_SESSION['existe']=true;
        return 0;    
    }else{
        return 1;
    }
}

function eh_grande($tamanho){
    if($tamanho > 5000000){
        $_SESSION['grande']=true;
        return 0;
    }else{
        return 1;
    }
}

function eh_jpg($tipo_arquivo){
    if($tipo_arquivo != "jpg"){
        $_SESSION['tipodiferente']=true;
        return 0;
    }else{
        return 1;
    }
}

function fazer_upload($carta, $caminho){
    if(move_uploaded_file($carta,$caminho)){
        return 1;
    }else{
        $_SESSION['deuruimupload']=true;
        return 0;
    }
}