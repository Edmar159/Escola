<?php include_once("../header.php") ?>

<?php 
	$nome = $_POST['nome'];

	if(isset($nome)){
		$result = mysqli_query($con, "SELECT * FROM projeto where status = 'aprovado' and nome_p like'%$nome%'");
	}else{
		$result = mysqli_query($con, "SELECT * FROM projeto where status = 'aprovado'");
	}

  $contRow = 0;
	if(isset($result)){
          while($projeto = mysqli_fetch_object($result)){
             $sql = mysqli_query($con, "SELECT sum(valor_doado) AS total FROM financiar WHERE cod_p_fk = '$projeto->codigo'");
            if($sum = mysqli_fetch_array($sql)){
              $soma = $sum['total'];
            }
            $numero = ($soma / $projeto->valor) * 100;
            $porcentagem = number_format($numero, 2);
            if($contRow == 0) echo '<div class = \'row\'>';
            $contRow++;

?>

          	<div class="col-md-4">
                <div class="thumbnail">
                  <!--<img src="../image/242x200.svg" alt="imagem">-->
                  <div class="embed-responsive embed-responsive-4by3">
                     <iframe class="embed-responsive-item" src="<?php echo $projeto->video ?>"></iframe>
                  </div>
                  <div class="caption">
                    <h3><?php echo $projeto->nome_p ?></h3>
                    <p><?php echo $projeto->descricao ?></p>
                    <div class="col-md-12">
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $porcentagem ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentagem ?>%;">
                          <?php echo $porcentagem ?>%
                        </div>
                      </div>
                    </div>
                    <p><a href="../Projeto/mostraProjeto.php?cod=<?php echo $projeto->codigo ?>" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Mais</a></p>
                  </div>
                </div>
              </div>
<?php
            if($contRow == 3){
              echo '</div>';
              $contRow = 0;
            } 
          }
  }
?>

<?php include_once("../footer.php") ?>