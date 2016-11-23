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
	$result = mysqli_query($con, "SELECT * FROM criterio where cod_cat_fk= '$cat'");				
	if ($cat == "Default"){
		if(isset($_GET['nome'])){
				$cod = $_GET['nome'];
				$result = mysqli_query($con, "SELECT * FROM criterio where nome_cri like'%$cod%'");
		}
	}

}


?>
<div class="row">
	 <div class="row col-md-12 col-md-offset-0">    	
	   	<div class="panel panel-primary">
			<div class="panel-heading">
					<h3 class="panel-title">Consulta Criterio de Avaliação</h3>
			</div>
			<div class="panel-body">
			<form class="form-horizontal" method="GET" action="buscarCriterio.php" >
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
					<div class="form-group">
						<label class="row col-md-3 control-label">Busca por nome</label>
						<div class="col-md-9">
						   	<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
							   	<input type="text" class="form-control" name="nome" placeholder="Nome" aria-describedby="basic-addon1">
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
			<?php 
			$aux =0;
			if(isset($result))
			{		
				if(mysqli_num_rows($result) > 0)
				{
				
					?>
					
					<div class="panel panel-primary">
		  			<div class="panel-heading">Resultado</div>
					<table class="table table-striped">
							<tr>
								<td><b>Nome </b></td>
								<td><b>Categoria</b></td>
								<td></td>
							
							</tr>
					<?php
					while($criterio = mysqli_fetch_object($result))
					{
						if($criterio->cod_cat_fk == 1){
							$categoria ="Pesquisa";
						}elseif($criterio->cod_cat_fk == 2){
							$categoria ="Competição Tecnológica";
						}elseif($criterio->cod_cat_fk == 3){
							$categoria ="Inovação no Ensino";
						}elseif($criterio->cod_cat_fk == 4){
							$categoria ="Manutenção e Reforma";
						}elseif($criterio->cod_cat_fk == 5){
							$categoria ="Pequenas Obras";
						}
					?>
						<tr>
							<td>
								<span class="detalhes"><a href="dadosCriterio.php?cod=<?php echo $criterio->cod_cri; ?>"><?php echo $criterio->nome_cri ?></a></span>
							</td>
							<td>
								<span class="detalhes"><a href="dadosCriterio.php?cod=<?php echo $criterio->cod_cri; ?>"><?php echo $categoria ?></a></span>
							</td>
							<td>
								<a class="btn btn-default btn-xs" href="dadosCriterio.php?cod=<?php echo $criterio->cod_cri; ?>" role="button"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Alterar</a>
							</td>
						
						</tr>
						
						<?php
					}
					?></table> <?php	
				}else
				{
				?>		
					<p class="bg-info"><b> Nenhum criterio de avaliação encontrado</b></p>				
				<?php
				}
			}
			?>
		</div>
	</div>
</div>


<?php include_once("../footer.php") ?>
