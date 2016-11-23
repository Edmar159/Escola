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

$result = mysqli_query($con, "SELECT * FROM projeto WHERE codigo = '$cod' and status = 'aprovado'");

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

<div class="row">

	<div class="row col-md-12 col-md-offset-0">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Finalizar projeto</h3>
			</div>
			<div class="panel-body">
			<form class="form-horizontal text-center" method="POST" action="finalizarProjeto.php?codigo=<?php echo ($cod) ?>">
				<div class="form-group">
					<div class="col-dm-4 col-dm-offset-4">
							Deseja realmente Finalizar o projeto do sistema ?
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-1 col-md-offset-4">
						<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span> Finalizar</button>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>

<?php include_once("../footer.php") ?>