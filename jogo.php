<?php

include('verifica_login.php');

include('conexao.php');



if(!isset($_SESSION['pontos'])){

  $pontos=0;

  $_SESSION['pontos']=0;

}

$pontos=$_SESSION['pontos'];

$usuario=$_SESSION['usuario'];

$query="SELECT bonusexcluir from usuarios where nome='$usuario'";
$beneficios01= selectUm($conexao,$query);

$query="SELECT bonusrevelar from usuarios where nome='$usuario'";
$beneficios02= selectUm($conexao,$query);

$query="SELECT dinheiro from usuarios where nome='$usuario'";
$dinheirinho=selectUm($conexao,$query);

$query="SELECT idtema from usuarios where nome='$usuario'";
$idtema=selectUm($conexao,$query);

$query="SELECT nome from temas where idtema='$idtema';";
$tema=selectUm($conexao,$query);
 

if(!isset($_SESSION['nivel'])){

  if(!isset($_POST['nivel'])){

    $_SESSION['nivel']=4;

  }else{

    $_SESSION['nivel']=$_POST['nivel'];

  }

}

  

$nivel = $_SESSION['nivel'];



// pegar do banco de dados a quantidade as cartas do tema

// select cartas from cartas where tema_id = itema limit 4

$query="SELECT nome from cartas where idtema='$idtema' limit $nivel;";

$resultado=mysqli_query($conexao,$query);

$cont=0;

while($cartas=mysqli_fetch_array($resultado)){

  $cartas_do_banco[$cont]=$cartas['nome'];

  $cont++;

}



if ($nivel == 4){

    $tempo = 30;

} else if ($nivel==6){

    $tempo = 45;

}else if ($nivel==8){

    $tempo = 60;

}else if ($nivel==10){

    $tempo = 75;

}else if ($nivel==12){

    $tempo = 90;

}



$aux = $nivel;

$vetor = [];

while($aux--) {

  $vetor[] = $aux + 1;

}



$cards = array_merge($vetor, $vetor);

shuffle($cards);



?>

<!DOCTYPE html>

<html lang="pt-br">

  <head>

      <meta charset="UTF-8">

      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <title>Jogo da Memória</title>

      <link rel ="stylesheet" type="text/css" href = "_css/jogo.css"/>

  </head>

  <body>

    <div id="interface">

      <header>

          <h1 id = "cabecalho" >Jogo da Memória</h1>

      </header>

      <div id="tempo">

        <h1 id=tempo> Tempo:</h1>

          <button class="tempo"   name="tempo">

          </button>

      </div>

      <section>

        <button class="dinheirinho" id="dinheirinho"> Dinheiro: <?php echo $dinheirinho ?> </button>

        <button class="pontos" id="pontos"> Pontuação: <?php echo $pontos ?> </button>

        <button class="revelar" id="beneficios02"  value= "$beneficios02"> Revelar: <?php echo $beneficios02 ?> </button>

        <button class="excluir" id="beneficios01"  value ='$beneficios01'> Excluir: <?php echo $beneficios01 ?> </button>

      </section>

      

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">

      </script>

      <div class="items" id="js-cards">

        <?php foreach($cards as $img): ?>

        <div class="item" data-img="<?php echo $img; ?>">

          <div class="card">

            <div class="flipper">

              <div class="front">

                <img src="_imagens/capa<?php echo $idtema;?>.jpg" alt="">

              </div>

              <div class="back">

                <img src="_imagens/<?php echo $cartas_do_banco[$img-1];?>" alt="">

              </div>

            </div>

          </div>

        </div>

        <?php endforeach; ?>

      </div>

      

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

      <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

      <script>    

        $(function() {

          // Total de cartas únicas

          const total = <?php echo (count($cards) / 2); ?>

          // Instâncias ao DOM

          const $cards = $('#js-cards')

          const $tempo = $('.tempo')

          const $pontos = $('#pontos')

          const $excluir = $('.excluir')

          const $revelar = $('.revelar')

          const $beneficios02 = $('#beneficios02')

          const $beneficios01 = $('#beneficios01')



          let beneficios01 = <?php echo $beneficios01; ?>;

          let beneficios02 = <?php echo $beneficios02; ?>;

          let par = 0;

          let nivel = <?php echo $nivel; ?>;

          let pontos = <?php echo $pontos; ?>;

          let $card = null

          let box = []

          let seconds = 0

          let gameover = false



        function gameOver(win) {

          gameover = true

          if(win){

          pontos = pontos + pontuacaoRodada(nivel)

          $cards.off('click')

          

          Swal.fire({

            title: win ? 'Você revelou tudo' : 'Perdeu',

            text: 'Quer começar outra rodada?',

            icon: win ? 'success' : 'error',

            confirmButtonText: 'Sim',

            showCancelButton: true,

            cancelButtonText: 'Não',              // delimitar o area clicável

            cancelButtonColor: "#00ff00"

          }).then(confirm => {

              $.get(`gameover.php?score=${pontos}&b1=${beneficios01}&b2=${beneficios02}`, 

              function(result) {

                if (confirm.value){

                  location.href = `/jogo.php`

                  }else{

                    location.href = `/ranking.php?nivel=${nivel}`

                  }

              }, "json");      

            

          })

          }else{

            pontos=pontos

            $.get(`gameover.php?score=${pontos}&b1=${beneficios01}&b2=${beneficios02}`)

            location.href = `/ranking.php?nivel=${nivel}`

          

          }

        }

        function close(a, b) {

          setTimeout(() => {

            a.removeClass('card--opened')

            b.removeClass('card--opened')

          }, 500)

        }

        function excluirCarta () {

          if (beneficios01>0){

               if (!$card==0){

                $card.removeClass('card--opened')

               $card = null

               }

                const card = Array(nivel).fill(0).map((_, idx) => idx + 1).filter(i => !box.includes(i))[0]

                $(`[data-img=${card}]`).each(function(){

                $(this).fadeOut(2000);

                })

                box.push(card);

                par++;

                pontos += pontuacaoPar(nivel);

                $pontos.html('Pontuação'+ pontos);

                $card = null

                beneficios01--;

                $beneficios01.html('Excluir Carta:'+ beneficios01);

            if (total === box.length) {

             gameOver(true)

                return

                }

                return

          } else {

            console.log('Não há beneficios!')

          }

        }

        function revelarCarta() {

          if (beneficios02>0){

              const card = $card.data('img') 

              $(`[data-img=${card}]`).each(function(){

              $(this).addClass('card--opened');

              })

                box.push(card);

                par++;

                pontos += pontuacaoPar(nivel);

                $pontos.html('Pontuação'+ pontos);

                $card = null

                beneficios02--;

                $beneficios02.html('Revelar Carta:'+ beneficios02);

            if (total === box.length) {

             gameOver(true)

                return

                }

                return

          } else {

            console.log('Não há beneficios!')

          }

        }

        function pontuacaoPar(nivel){

          pontuacao =0;

          if (nivel == 4) {

            pontuacao=10;

            return pontuacao;

          }else if (nivel==6){

            pontuacao=20;

            return pontuacao;

          } else if (nivel==8){

            pontuacao=30;

            return pontuacao;

          } else if (nivel==10){

            pontuacao=40;

            return pontuacao;

          } else if (nivel==12){

            pontuacao=50;

            return pontuacao;

          } 

        }



        function pontuacaoRodada(nivel){

          pontuacao =0;

          if (nivel == 4) {

            pontuacao=60;

            return pontuacao;

          }else if (nivel==6){

            pontuacao=80;

            return pontuacao;

          } else if (nivel==8){

            pontuacao=60;

            return pontuacao;

          } else if (nivel==10){

            pontuacao=50;

            return pontuacao;

          } else if (nivel==12){

            pontuacao=100;

            return pontuacao;

          } 

        }



        $revelar.on('click',revelarCarta);

        $beneficios01.on('click',excluirCarta);

        $cards.on('click', 'img', function() {

          const $clicked = $(this).closest('.item')

          // estou dentro da caixa?

          if (box.includes($clicked.data('img'))) {

            return

          }

          if (!$card) {

            $clicked.addClass('card--opened')

            $card = $clicked

            return

          }

          if ($clicked.is($card)) {

            $clicked.removeClass('card--opened')

            $card = null

            return

          }

          $clicked.addClass('card--opened')

          if ($clicked.data('img') === $card.data('img')) {

            box.push($clicked.data('img'))

            par++;

            $card = null

            pontos += pontuacaoPar(nivel);

            $pontos.html('Pontuação'+ pontos);

            if (total === box.length) {

              gameOver(true)

            }

            return

          }

          close($clicked, $card)

          $card = null

        })

        const showSeconds = (sec) => {

          if (gameover) return

          $tempo.html(sec)

          if (sec === 0) {

            gameOver(false)

            return

          }

          seconds = sec

          setTimeout(() => showSeconds(sec - 1), 1000)

        }

        showSeconds(<?php echo $tempo; ?>)

        })

      </script>

      <footer id="rodape">

        <p> Copyright &copy; 2020 - by <a href="https://www.linkedin.com/in/ester-toja-692a6566/"    target="_blank"> Ester Toja </a>| <a href="https://www.linkedin.com/in/igor-bandasz-864410167/"    target="_blank"> Igor Bandasz </a>| <a href="https://www.linkedin.com/in/roberta-dias-182797140/   "  target="_blank"> Roberta Dias</a> </p>

      </footer>

    </div>

  </body>

</html>





