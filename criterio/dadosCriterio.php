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

$cod= $_GET['cod'];
$_SESSION["codigo"] = $cod;

$result = mysqli_query($con, "SELECT * FROM criterio WHERE cod_cri = '$cod'");

?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Dados do criterio de avaliação</h3>
			</div>
			<?php 
			if(isset($result))
			{		
				if(mysqli_num_rows($result) > 0)
				{
				
					?><table class="table table-striped">
							<tr>
								<td><b>Codigo</b></td>
								<td><b>Nome</b></td>
								<td><b>Categoria</b></td>
								<td><b>Peso</b></td>
								<td><b>Descrição</b></td>
							</tr>
					<?php
					if($criterio = mysqli_fetch_object($result))
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
						<td><span class="detalhes"><?php echo $criterio->cod_cri ?></span></td>
						<td><span class="detalhes"><?php echo $criterio->nome_cri ?></span></td>
						<td><span class="detalhes"><?php echo $categoria ?></span></td>
						<td><span class="detalhes"><?php echo $criterio->peso ?></span></td>
						<td><span class="detalhes"><?php echo $criterio->descricao ?></span></td>
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

<?php 

$result = mysqli_query($con, "SELECT * FROM criterio WHERE cod_cri = '$cod'");

?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Alterar dados do criterio de avaliação</h3>
			</div>			
			<div class="panel-body">
				<?php 
				if(isset($result))
				{		
					if(mysqli_num_rows($result) > 0)
					{
				?>
				<form class="form-horizontal" method="POST" action="alterarCriterio.php?codigo=<?php echo ($cod) ?>">
					<?php
					if($criterio = mysqli_fetch_object($result))
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
						<div class="form-group">
							<label class="col-md-3 control-label">Nome</label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="nome" placeholder="<?php echo $criterio->nome_cri ?>">
							</div>
						</div>
						<div class="form-group">
						    <label class="col-md-3 control-label">Categoria</label>
							<div class="col-md-8">
								<select class="form-control" name="categoria">
										<option value=<?php echo $criterio->cod_cat_fk ?>><?php echo $categoria ?></option>
										<option value="1">Pesquisa</option> 
										<option value="2">Competição Tecnológica</option> 
										<option value="3">Inovação no Ensino</option> 
										<option value="4">Manutenção e Reforma</option> 
										<option value="5">Pequenas Obras</option>
								</select>
							</div>
						</div>						
						<div class="form-group">
						 	<label class="col-md-3 control-label">Peso</label>
							<div class="col-md-8">
								<select class="form-control" name="peso">
										<option value=<?php echo $criterio->peso ?>><?php echo $criterio->peso ?></option>
										<option value="1">1</option> 
										<option value="2">2</option> 
										<option value="3">3</option> 
										<option value="4">4</option> 
										<option value="5">5</option>
										<option value="6">6</option> 
										<option value="7">7</option> 
										<option value="8">8</option> 
										<option value="9">9</option> 
										<option value="10">10</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Descrição</label>
						    <div class="col-md-8">
							   	<textarea class="form-control" rows="3" name="descricao" placeholder=<?php echo $criterio->descricao ?>></textarea>
						    </div>
						</div>
						<div class="form-group">
						    <div class="col-md-2 col-md-offset-9">
						      <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Atualizar</button>
						    </div>
						</div>
					<?php
					}
					?>
				</form>
				<?php	
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

	<!--
	<div class="row col-md-5 col-md-offset-0">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Remover dados do criterio de avaliação</h3>
			</div>
			<div class="panel-body">
			<form class="form-horizontal text-center" method="POST" action="deletarCriterio.php?codigo=<?php echo ($cod) ?>" >
				<div class="form-group">
					<div class="col-dm-4 col-dm-offset-4">
							Deseja realmente remover o criterio de avaliação do sistema ?
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-1 col-md-offset-4">
						<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir</button>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
	-->
</div>
<?php include_once("../footer.php") ?>