<?php include_once("../header.php") ?>

<div class="mensagme text-center col-md-12">
	<?php 

	if(isset($_GET['error']))
	{
		?> 
			<p class="bg-danger" style="color:red"><?php echo $_GET['error'] ?></p>
		<?php
	} 
	else if(isset($_GET['success']))
	{
		?> 
			<p class="bg-success" style="color:green"><?php echo $_GET['success'] ?></p>
		<?php
	}


	?>

	<?php 
		$cod = $_GET['cod'];
	 ?>
</div>

<?php 
	$cod= $_GET['cod'];

	$result = mysqli_query($con, "SELECT * FROM projeto WHERE codigo = '$cod'");

	if(isset($result))
	{
		$projeto = mysqli_fetch_object($result);
		if($projeto->cod_cat_fk == 1){
			$categoria ="Pesquisa";
		}elseif($projeto->cod_cat_fk == 2){
			$categoria ="Competição Tecnológica";
		}elseif($projeto->cod_cat_fk == 3){
			$categoria ="Inovação no Ensino";
		}elseif($projeto->cod_cat_fk == 4){
			$categoria ="Manutenção e Reforma";
		}elseif($projeto->cod_cat_fk == 5){
			$categoria ="Pequenas Obras";
		}

		$sql = mysqli_query($con, "SELECT sum(valor_doado) AS total FROM financiar WHERE cod_p_fk = '$cod'");
		if($sum = mysqli_fetch_array($sql)){
			$soma = $sum['total'];
		}

		$sql = mysqli_query($con, "SELECT COUNT(cpf_fk) AS total FROM financiar WHERE cod_p_fk = '$cod'");
		if($count = mysqli_fetch_array($sql)){
			$contar = $count['total'];
		}

		$numero = ($soma / $projeto->valor) * 100;
        $porcentagem = number_format($numero, 2);
 ?>

<div class="row">
	<h1 class="text-center"><strong><?php echo $projeto->nome_p ?></strong></h1>
</div>
<div class="jumbotron">
<div class="container">
	<div class="col-md-8">
		<div class="embed-responsive embed-responsive-16by9">
		  <iframe class="embed-responsive-item" src="<?php echo $projeto->video ?>"></iframe>
		</div>	
	</div>
	<div class="col-md-4" >
		<div class="row list-group-item" style="background-color: white">
			<div class="col-md-10 col-md-offset-1">
				<div class="row">
					<h3><strong>R$ <?php echo number_format($soma, 2, ',', '.') ?></strong> <br>
					<small>apoiados por <strong> <?php echo $contar ?> pessoas</strong></small>
					</h3>
				</div>
				<div class="row">
					<div class="progress">
					  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $porcentagem ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentagem ?>%;">
					    <?php echo $porcentagem ?>%
					  </div>
					</div>
				</div>			
				<div class="row">
					<dl>
					  <dt>Meta R$: <?php echo number_format($projeto->valor, 2, ',', '.') ?></dt>
					  <dd><b>Categoria:</b> <?php echo $categoria ?></dd>
					</dl>
				</div>
			</div>
		</div>
		<div class="row list-group-item">
			<div class="col-md-2 col-md-offset-2">					    	
				<a class="btn btn-primary" href="financiaProjeto.php?cod=<?php echo $cod ?>" role="button"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Apoiar Projeto</a>
			</div>
		</div>
	</div>		
</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
		 	<div class="panel-heading"><b>Descrição</b></div>
		  	<div class="panel-body">
		    	<p><?php echo $projeto->descricao ?></p>
		  	</div>
		</div>
	</div>
</div>

<?php 
	}else{
		?>
		<p class="bg-info"><b> Nenhum projeto encontrado</b></p>
		<?php
	}
 ?>

<?php include_once("../footer.php") ?>