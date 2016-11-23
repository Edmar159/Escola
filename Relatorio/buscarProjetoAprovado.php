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
	$result = mysqli_query($con, "SELECT * FROM projeto where cod_cat_fk= '$cat' and status = 'aprovado'");				
	if ($cat == "Default"){
		if(isset($_GET['codigo'])){
				$cod = $_GET['codigo'];
				$result = mysqli_query($con, "SELECT * FROM projeto where status = 'aprovado' and (codigo = '$cod' or nome_p like'%$cod%')");
		}
	}

}


?>
<div class="row">
	 <div class="row col-md-12 col-md-offset-0">    	
	   	<div class="panel panel-primary">
			<div class="panel-heading">
					<h3 class="panel-title">Consulta Projeto Candidato</h3>
			</div>
			<div class="panel-body">
			<form class="form-horizontal" method="GET" action="buscarProjetoAprovado.php" >
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
						<label class="row col-md-3 control-label">Busca por codigo / nome</label>
						<div class="col-md-9">
						   	<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
							   	<input type="text" class="form-control" name="codigo" placeholder="Codigo ou nome" aria-describedby="basic-addon1">
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
								<td></td>
								<td><b>Nome </b></td>
								<td><b>Categoria</b></td>
								<td><b>Custo Estimado </b></td>
								<td><b>Duração Estimada</b></td>
								<td><b>Descrição</b></td>
							</tr>
					<?php
					while($projeto = mysqli_fetch_object($result))
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
						<tr>
							<td> 
								<a href="investimentoFinanceiro.php?cod=<?php echo $projeto->codigo; ?>">
									<img src='../Projeto/fotos/<?php echo $projeto->imagem ?>' alt='Foto de Exibição' heigh="50" width="50"  />
								</a>
							</td>
							<td>
								<span class="detalhes"><a href="investimentoFinanceiro.php?cod=<?php echo $projeto->codigo; ?>"><?php echo $projeto->nome_p ?></a></span>
							</td>
							<td>
								<span class="detalhes"><a href="investimentoFinanceiro.php?cod=<?php echo $projeto->codigo; ?>"><?php echo $categoria_p ?></a></span>
							</td>
							<td>
								<span class="detalhes"><a href="investimentoFinanceiro.php?cod=<?php echo $projeto->codigo; ?>"><?php echo $projeto->valor ?></a></span>
							</td>
							<td>
								<span class="detalhes"><a href="investimentoFinanceiro.php?cod=<?php echo $projeto->codigo; ?>"><?php echo $projeto->duracao ?></a></span>
							</td>
							<td>
								<a href="investimentoFinanceiro.php?cod=<?php echo $projeto->codigo; ?>">
									<span class="detalhes"><?php echo $projeto->descricao ?></span>
								</a>
							</td>
						</tr>
						
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


<?php include_once("../footer.php") ?>