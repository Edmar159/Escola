<?php include_once("../header.php") ?>
<?php include_once("../validar.php") ?>

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
</div>

<?php

if(isset($_GET['categoria']))
{	
	$cat = $_GET['categoria'];			
	if ($cat != "Default"){
		$result = mysqli_query($con, "SELECT * FROM projeto where cod_cat_fk= '$cat' and status = 'aprovado'");
	}else {
		$result1 = mysqli_query($con, "SELECT * FROM projeto where cod_cat_fk= 1 and status = 'aprovado'");
		$result2 = mysqli_query($con, "SELECT * FROM projeto where cod_cat_fk= 2 and status = 'aprovado'");
		$result3 = mysqli_query($con, "SELECT * FROM projeto where cod_cat_fk= 3 and status = 'aprovado'");
		$result4 = mysqli_query($con, "SELECT * FROM projeto where cod_cat_fk= 4 and status = 'aprovado'");
		$result5 = mysqli_query($con, "SELECT * FROM projeto where cod_cat_fk= 5 and status = 'aprovado'");
	}
}


?>
<div class="row">
	 <div class="row col-md-12 col-md-offset-0">    	
	   	<div class="panel panel-primary">
			<div class="panel-heading">
					<h3 class="panel-title">Relatório de Projetos por Categoria</h3>
			</div>
			<div class="panel-body">
			<form class="form-horizontal" method="GET" action="projetosCategoria.php" >
					<div class="form-group">
					    <label class="row col-md-3 control-label">Busca por categoria</label>
						<div class="col-md-9">
							<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-filter" aria-hidden="true"></span></span>
							<select class="form-control" name="categoria" aria-describedby="basic-addon1">
									<option value="Default">Selecionar Opção</option> 
									<option value="1">Pesquisa</option> 
									<option value="2">Competição Tecnológica</option> 
									<option value="3">Inovação no Ensino</option> 
									<option value="4">Manutenção e Reforma</option> 
									<option value="5">Pequenas Obras</option>
							</select>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-md-offset-10">
						<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>
					</div>
			</form>
			</div>
		</div>
	</div>
</div>
<div class="row ">
	<div class="col-md-12 col-md-offset-0">			
		<div class="col-md-4">
			<?php 
			$aux =0;
			if(isset($result))
			{		
				if(mysqli_num_rows($result) != 0)
				{
					
					if($cat == 1){
						$categoria_p ="Pesquisa";
					}elseif($cat == 2){
						$categoria_p ="Competição Tecnológica";
					}elseif($cat == 3){
						$categoria_p ="Inovação no Ensino";
					}elseif($cat == 4){
						$categoria_p ="Manutenção e Reforma";
					}elseif($cat == 5){
						$categoria_p ="Pequenas Obras";
					}
					?>

					<div class="panel panel-primary">
		  			<div class="panel-heading"><?php echo $categoria_p ?></div>
					<table class="table table-striped">
							<tr>
								<td><b>Nome</b></td>
								<td><b>Valor Investido</b></td>
							</tr>
					<?php
					$total = 0;
					while($projeto = mysqli_fetch_object($result))
					{
						$sql = mysqli_query($con, "SELECT sum(valor_doado) AS total FROM financiar WHERE cod_p_fk = '$projeto->codigo'");
				      if($sum = mysqli_fetch_array($sql)){
				        $soma = $sum['total'];
							$total += $soma;
				      }
					?>
						<tr>
							<td>
								<span class="detalhes"><a href="/pfcoletivo/Projeto/mostraProjeto.php?cod=<?php echo $projeto->codigo; ?>"><?php echo $projeto->nome_p ?></a></span>
							</td>
							<td>
								<span class="detalhes"><a href="/pfcoletivo/Projeto/mostraProjeto.php?cod=<?php echo $projeto->codigo; ?>"><?php if(isset($soma)){ echo $soma; } else { echo '0'; } ?></a></span>
							</td>
						</tr>
						
						<?php
					}
					?>
					<tr>
						<td>
							Total
						</td>
						<td>
							<?php echo $total ?>
						</td>
					</tr>
					</table> 
					</div>
				<?php
				}else
				{
				?>		
					<p class="bg-info"><b> Nenhum projeto encontrado</b></p>				
				<?php
				}
				
				}
				?>
				<?php		
				if(isset($result1))
					{		
						if(mysqli_num_rows($result1) != 0)
						{
							?>
							<div class="panel panel-primary">
				  			<div class="panel-heading">Pesquisa</div>
							<table class="table table-striped">
									<tr>
										<td class="col-md-6"><b>Nome</b></td>
										<td class="col-md-6"><b>Valor Investido</b></td>
									</tr>
							<?php
							$total = 0;
							while($projeto = mysqli_fetch_object($result1))
							{
								$sql = mysqli_query($con, "SELECT sum(valor_doado) AS total FROM financiar WHERE cod_p_fk = '$projeto->codigo'");
								if($sum = mysqli_fetch_array($sql)){
								  $soma = $sum['total'];
									$total += $soma;
								}
							?>
								<tr>
									<td class="col-md-6">
										<span class="detalhes"><a href="/pfcoletivo/Projeto/mostraProjeto.php?cod=<?php echo $projeto->codigo; ?>"><?php echo $projeto->nome_p ?></a></span>
									</td>
									<td class="col-md-6">
										<span class="detalhes"><a href="/pfcoletivo/Projeto/mostraProjeto.php?cod=<?php echo $projeto->codigo; ?>"><?php if(isset($soma)){ echo $soma; } else { echo '0'; } ?></a></span>
									</td>
								</tr>
						
								<?php
							}
							?>
							<tr>
								<td class="col-md-6">
									Total
								</td>
								<td class="col-md-6">
									<?php echo $total ?>
								</td>
							</tr>
							</table> 
							</div>
						<?php
						}
						?>
				<?php
					}if(isset($result2))
					{		
						if(mysqli_num_rows($result2) != 0)
						{
							?>
							<div class="panel panel-primary">
				  			<div class="panel-heading">Competição Tecnológica</div>
							<table class="table table-striped">
									<tr>
										<td class="col-md-6"><b>Nome</b></td>
										<td class="col-md-6"><b>Valor Investido</b></td>
									</tr>
							<?php
							$total = 0;
							while($projeto = mysqli_fetch_object($result2))
							{
								$sql = mysqli_query($con, "SELECT sum(valor_doado) AS total FROM financiar WHERE cod_p_fk = '$projeto->codigo'");
								if($sum = mysqli_fetch_array($sql)){
								  $soma = $sum['total'];
									$total += $soma;
								}
							?>
								<tr>
									<td class="col-md-6">
										<span class="detalhes"><a href="/pfcoletivo/Projeto/mostraProjeto.php?cod=<?php echo $projeto->codigo; ?>"><?php echo $projeto->nome_p ?></a></span>
									</td>
									<td class="col-md-6">
										<span class="detalhes"><a href="/pfcoletivo/Projeto/mostraProjeto.php?cod=<?php echo $projeto->codigo; ?>"><?php if(isset($soma)){ echo $soma; } else { echo '0'; } ?></a></span>
									</td>
								</tr>
						
								<?php
							}

							?>
							<tr>
								<td class="col-md-6">
									Total
								</td>
								<td class="col-md-6">
									<?php echo $total ?>
								</td>
							</tr>
							</table> 
							</div>
						<?php
						}
						?>
					<?php
					}if(isset($result3))
					{		
						if(mysqli_num_rows($result3) != 0)
						{
							?>
							<div class="panel panel-primary">
				  			<div class="panel-heading">Inovação no Ensino</div>
							<table class="table table-striped">
									<tr>
										<td class="col-md-6"><b>Nome</b></td>
										<td class="col-md-6"><b>Valor Investido</b></td>
									</tr>
							<?php
							$total = 0;
							while($projeto = mysqli_fetch_object($result3))
							{
								$sql = mysqli_query($con, "SELECT sum(valor_doado) AS total FROM financiar WHERE cod_p_fk = '$projeto->codigo'");
								if($sum = mysqli_fetch_array($sql)){
								  $soma = $sum['total'];
									$total += $soma;
								}
							?>
								<tr>
									<td class="col-md-6">
										<span class="detalhes"><a href="/pfcoletivo/Projeto/mostraProjeto.php?cod=<?php echo $projeto->codigo; ?>"><?php echo $projeto->nome_p ?></a></span>
									</td>
									<td class="col-md-6">
										<span class="detalhes"><a href="/pfcoletivo/Projeto/mostraProjeto.php?cod=<?php echo $projeto->codigo; ?>"><?php if(isset($soma)){ echo $soma; } else { echo '0'; } ?></a></span>
									</td>
								</tr>
						
								<?php
							}
						
							?>
							<tr>
								<td class="col-md-6">
									Total
								</td>
								<td class="col-md-6">
									<?php echo $total ?>
								</td>
							</tr>
							</table> 
							</div>
						<?php
						}
						?>
					<?php
					}if(isset($result4))
					{		
						if(mysqli_num_rows($result4) != 0)
						{
							?>
							<div class="panel panel-primary">
				  			<div class="panel-heading">Manutenção e Reforma</div>
							<table class="table table-striped">
									<tr>
										<td class="col-md-6"><b>Nome</b></td>
										<td class="col-md-6"><b>Valor Investido</b></td>
									</tr>
							<?php
							$total = 0;
							while($projeto = mysqli_fetch_object($result4))
							{
								$sql = mysqli_query($con, "SELECT sum(valor_doado) AS total FROM financiar WHERE cod_p_fk = '$projeto->codigo'");
								if($sum = mysqli_fetch_array($sql)){
								  $soma = $sum['total'];
									$total += $soma;
								}
							?>
								<tr>
									<td class="col-md-6">
										<span class="detalhes"><a href="/pfcoletivo/Projeto/mostraProjeto.php?cod=<?php echo $projeto->codigo; ?>"><?php echo $projeto->nome_p ?></a></span>
									</td>
									<td class="col-md-6">
										<span class="detalhes"><a href="/pfcoletivo/Projeto/mostraProjeto.php?cod=<?php echo $projeto->codigo; ?>"><?php if(isset($soma)){ echo $soma; } else { echo '0'; } ?></a></span>
									</td>
								</tr>
						
								<?php
							}
						
						?>
						<tr>
							<td class="col-md-6">
								Total
							</td>
							<td class="col-md-6">
								<?php echo $total ?>
							</td>
						</tr>
						</table> 
						</div>
						<?php
						}
						?>
					<?php
					}if(isset($result5))
					{		
						if(mysqli_num_rows($result5) != 0)
						{
							?>
							<div class="panel panel-primary">
				  			<div class="panel-heading">Pequenas Obras</div>
							<table class="table table-striped">
									<tr>
										<td class="col-md-6"><b>Nome</b></td>
										<td class="col-md-6"><b>Valor Investido</b></td>
									</tr>
							<?php
							$total = 0;
							while($projeto = mysqli_fetch_object($result5))
							{
								$sql = mysqli_query($con, "SELECT sum(valor_doado) AS total FROM financiar WHERE cod_p_fk = '$projeto->codigo'");
								if($sum = mysqli_fetch_array($sql)){
								  $soma = $sum['total'];
									$total += $soma;
								}
							?>
								<tr>
									<td class="col-md-6">
										<span class="detalhes"><a href="/pfcoletivo/Projeto/mostraProjeto.php?cod=<?php echo $projeto->codigo; ?>"><?php echo $projeto->nome_p ?></a></span>
									</td>
									<td class="col-md-6">
										<span class="detalhes"><a href="/pfcoletivo/Projeto/mostraProjeto.php?cod=<?php echo $projeto->codigo; ?>"><?php if(isset($soma)){ echo $soma; } else { echo '0'; } ?></a></span>
									</td>
								</tr>
						
								<?php
							}
							?>
					<tr>
						<td class="col-md-6">
							Total
						</td>
						<td class="col-md-6">
							<?php echo $total ?>
						</td>
					</tr>
					</table> 
					</div>
				<?php
						}	
					}
					?>
			</div>
			<?php if(isset($_GET['categoria'])){ ?>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Gráfico</h3>
					</div>
					<div class="panel-body">
						<img src="graficoCategoria.php" class="img-responsive"/>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>


<?php include_once("../footer.php") ?>
