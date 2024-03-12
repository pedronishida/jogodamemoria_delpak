<?php
/**Sorteia os nomes das cartas já com os pares e armazena em um vetor***/
    function sorteia($nivel){
        $tam=0;
        $cont=0;
        for ($i=0;$i<($nivel*2);$i++){
        $vetPosicao[$i] = rand(1,$nivel);
        $tam++;
            for ($j=0;$j<$tam-1;$j++){
                if ($vetPosicao[$i]==$vetPosicao[$j]){
                    $cont++;
                    if ($cont==2){
                        $vetPosicao[$i]=NULL;
                        $i--;
                        $tam--;
                        break;
                    }
                }
            }
        $cont=0;
        } 
        return $vetPosicao;
    } 
?>
