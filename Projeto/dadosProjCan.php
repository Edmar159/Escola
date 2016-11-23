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

$result = mysqli_query($con, "SELECT * FROM projeto WHERE codigo = '$cod'");

?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Dados do projeto candidato</h3>
			</div>
			<?php 
			if(isset($result))
			{		
				if(mysqli_num_rows($result) > 0)
				{
				
					?><table class="table table-striped">
							<tr>
								<td></td>
								<td><b>Codigo</b></td>
								<td><b>Nome</b></td>
								<td><b>Categoria</b></td>
								<td><b>Duração prevista</b></td>
								<td><b>Valor previsto</b></td>
								<td><b>Status</b></td>
								<td><b>Descrição</b></td>								
							</tr>
					<?php
					if($projeto = mysqli_fetch_object($result))
					{
						if($projeto->cod_cat_fk == 1){
							$categoria_p ="Pesquisa";
						}elseif($projeto->cod_cat_fk == 2){
							$categoria_p ="Competição Tecnológica";
						}elseif($projeto->cod_cat_fk == 3){
							$categoria_p ="Inovação no Ensino";
						}elseif($projeto->cod_cat_fk == 4){
							$categoria_p ="Manutenção e Reforma";
						}elseif($projeto->cod_cat_fk == 5){
							$categoria_p ="Pequenas Obras";
						}
					?>	
						<td><img src='fotos/<?php echo $projeto->imagem ?>' alt='Foto de Exibição' heigh="50" width="50"  /></td>				
						<td><span class="detalhes"><?php echo $projeto->codigo ?></span></td>
						<td><span class="detalhes"><?php echo $projeto->nome_p ?></span></td>
						<td><span class="detalhes"><?php echo $categoria_p ?></span></td>
						<td><span class="detalhes"><?php echo $projeto->duracao ?></span></td>
						<td><span class="detalhes"><?php echo $projeto->valor ?></span></td>
						<td><span class="detalhes"><?php echo $projeto->status ?></span></td>
						<td><span class="detalhes"><?php echo $projeto->descricao ?></span></td>
						
					<?php
					}
					?></table> <?php	
				}else
				{		
				?>		
					<p class="bg-info"><b> Nenhum projeto encontrado</b></p>				
				<?php
				}
			}
			?>
		</div>
	</div>
</div>

<?php 

$result = mysqli_query($con, "SELECT * FROM projeto WHERE codigo = '$cod'");

?>

<?php if( $_SESSION["tipo"] == "gestor" ){ ?>
<div class="row">
	<div class="col-md-7">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Alterar dados do projeto</h3>
			</div>			
			<div class="panel-body">
				<?php 
				if(isset($result))
				{		
					if(mysqli_num_rows($result) > 0)
					{
				?>
				<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="updateProjeto.php?codigo=<?php echo ($cod) ?>">
					<?php
					if($projeto = mysqli_fetch_object($result))
					{
						if($projeto->cod_cat_fk == 1){
							$categoria_p ="Pesquisa";
						}elseif($projeto->cod_cat_fk == 2){
							$categoria_p ="Competição Tecnológica";
						}elseif($projeto->cod_cat_fk == 3){
							$categoria_p ="Inovação no Ensino";
						}elseif($projeto->cod_cat_fk == 4){
							$categoria_p ="Manutenção e Reforma";
						}elseif($projeto->cod_cat_fk == 5){
							$categoria_p ="Pequenas Obras";
						}
					?>
						<div class="form-group">
							<label class="col-md-3	 control-label">Imagem</label>
							<div class="col-md-9">
								<input type="file" name="arquivo">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Nome</label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="nome" placeholder="<?php echo $projeto->nome_p ?>">
							</div>
						</div>
						<div class="form-group">
						    <label class="col-md-3 control-label">Categoria</label>
							<div class="col-md-8">
								<select class="form-control" name="categoria">
										<option value="0"><?php echo $categoria_p ?></option>
										<option value="1">Pesquisa</option> 
										<option value="2">Competição Tecnológica</option> 
										<option value="3">Inovação no Ensino</option> 
										<option value="4">Manutenção e Reforma</option> 
										<option value="5">Pequenas Obras</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Duração</label>
							<div class="col-md-8">
								<input type="number" class="form-control" name="duracao" placeholder=<?php echo $projeto->duracao ?>>
							</div>
						</div>
						<div class="form-group">
						    <label class="col-md-3 control-label" >*Valor Previsto</label>
						    <div class="col-md-8">
							    <div class="input-group">
							    	<div class="input-group-addon">R$</div>
							      	<input type="text" class="form-control" name="valor" placeholder=<?php echo $projeto->valor ?>>
							      	<div class="input-group-addon">.00</div>
							    </div>					    	
						    </div>
						</div>

						<div class="form-group">
							<label class="col-md-3	 control-label">Link vídeo</label>
							<div class="col-md-8">
								<input type="text" class="form-control"  name="url" placeholder="URL">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3	 control-label">*Descrição do projeto</label>
							<div class="col-md-8">
								<textarea  class="form-control" rows="3" name="descricao" size=255 placeholder=<?php echo $projeto->descricao ?>></textarea>
							</div>
						</div>
						<div class="form-group">
					    <div class="col-md-2 col-md-offset-7">
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
						<p class="bg-info"><b> Nenhum projeto encontrado</b></p>				
					<?php
					}
				}
				?>
			</div>
		</div>
	</div>
	<div class="row col-md-5 col-md-offset-0">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Remover dados do projeto</h3>
			</div>
			<div class="panel-body">
			<form class="form-horizontal text-center" method="POST" action="deletarProjeto.php?codigo=<?php echo ($cod) ?>">
				<div class="form-group">
					<div class="col-dm-4 col-dm-offset-4">
							Deseja realmente remover o projeto do sistema ?
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
</div>

<?php } ?>

<?php include_once("../footer.php") ?>