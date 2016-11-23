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
						<td><img src='../Projeto/fotos/<?php echo $projeto->imagem ?>' alt='Foto de Exibição' heigh="50" width="50"  /></td>				
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

<?php if( $_SESSION["tipo"] == "avaliador" ){ 
	$result = mysqli_query($con, "SELECT * FROM critproj WHERE cod_p_fk = '$projeto->codigo'");
	if(mysqli_num_rows($result) > 0)
	{
		?>
	<div class="row">
		<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Alterar avaliação</h3>
			</div>			
			<div class="panel-body">
			
					<table class="table table-striped">
						<tr>		
							<td><b>Nome </b></td>
							<td><b>Descrição</b></td>
							<td><b>Nota </b></td>
							<td></td>
						</tr>
						
						<?php 
						While($critproj = mysqli_fetch_object($result))
						{ 
							$result2 = mysqli_query($con, "SELECT * FROM criterio WHERE cod_cri = '$critproj->cod_cri_fk'");
							if($criterio = mysqli_fetch_object($result2)){
							?>
								<tr>
									<form class="form-horizontal" method="POST" action="updateAval.php?codigo=<?php echo ($cod) ?>&cri=<?php echo ($critproj->cod_cri_fk) ?>">
										<td class="col-md-2">
											<label><?php echo $criterio->nome_cri?> </label>
										</td>
										<td>
											<textarea  class="form-control" rows="3" name="desc_cri" size=255 placeholder=<?php echo $critproj->comentario ?>></textarea>
											
										</td>
										<td>
											<div class="col-md-6">
											<select class="form-control" name="nota_cri" >
												<option value="<?php echo $critproj->nota ?>"><?php echo $critproj->nota ?></option> 
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
											
										</td>
										<td> 
											<button type="submit" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Atualizar</button>
						    				
										</td>
									</form>
								</tr>
						<?php }
						} ?>
						
							
					</table> 	
		
			</div>
		</div>
	</div>
</div>

<?php }
 } ?>

<?php include_once("../footer.php") ?>