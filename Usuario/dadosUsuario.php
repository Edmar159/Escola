<?php include_once("../header.php") ?>
<?php include_once("../validar.php") ?>

<?php 

$cpf = $_GET['cpf'];

$result = mysqli_query($con, "SELECT * FROM usuario WHERE cpf = '$cpf'");

 

?>
	 
<div class="row col-md-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Dados do usuario</h3>
		</div>
		<?php 
		$aux =0;
		if(isset($result))
		{		
			if(mysqli_num_rows($result) > 0)
			{
			
				?><table class="table table-striped">
						<tr>
							<td><b>Login</b></td>
							<td><b>Nome</b></td>
							<td><b>Pais</b></td>
							<td><b>Cidade</b></td>
							<td><b>Estado</b></td>
							<td><b>Data de nascimento</b></td>
							<td><b>E-mail</b></td>
							<td><b>Tipo</b></td>
							<td><b>Categoria</b></td>

						</tr>
				<?php
				while($usuario = mysqli_fetch_object($result))
				{
				?>					
					<td><span class="detalhes"><?php echo $usuario->login ?></span></td>
					<td><span class="detalhes"><?php echo $usuario->nome ?></span></td>
					<td><span class="detalhes"><?php echo $usuario->pais ?></span></td>
					<td><span class="detalhes"><?php echo $usuario->cidade ?></span></td>
					<td><span class="detalhes"><?php echo $usuario->estado ?></span></td>
					<td><span class="detalhes"><?php echo $usuario->data_n ?></span></td>
					<td><span class="detalhes"><?php echo $usuario->email ?></span></td>
					<td><span class="detalhes"><?php echo $usuario->tipo ?></span></td>
					<td><span class="detalhes"><?php echo $usuario->categoria ?></span></td>
				<?php
				}
				?></table> <?php	
			}elseif($aux = 0)
			{
			?>		
				<p class="bg-info"><b> Nenhum usuario encontrado</b></p>				
			<?php
			}
		}
		?>
	</div>
</div>

<?php 

$result = mysqli_query($con, "SELECT * FROM financiar WHERE cpf_fk = '$cpf'");

?>

<div class="row col-md-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Projetos fianciados</h3>
		</div>
		<?php 
		$aux =0;
		if(isset($result))
		{		
			if(mysqli_num_rows($result) > 0)
			{
			
				?><table class="table table-striped">
						<tr>
							<td></td>
							<td><b>Nome</b></td>
							<td><b>Descrição</b></td>
							<td><b>Valor doado</b></td>
							<td><b>Data</b></td>
						</tr>
				<?php
				while($financiar = mysqli_fetch_object($result))
				{
					$resultProj = mysqli_query($con, "SELECT * FROM projeto WHERE codigo = '$financiar->cod_p_fk'");
					$projeto = mysqli_fetch_object($resultProj);
				?>
				<tr>
					<td><img src='../Projeto/fotos/<?php echo $projeto->imagem ?>' alt='Foto de Exibição' heigh="50" width="50"  /></td>
					<td><span class="detalhes"><?php echo $projeto->nome_p ?></span></td>
					<td><span class="detalhes"><?php echo $projeto->descricao ?></span></td>
					<td><span class="detalhes"><?php echo $financiar->valor_doado ?></span></td>
					<td><span class="detalhes"><?php echo $financiar->data_fin ?></span></td>
				</tr>
				<?php
				}
				?></table> <?php	
			}elseif($aux = 0)
			{
			?>		
				<p class="bg-info"><b> Nenhum usuario encontrado</b></p>				
			<?php
			}
		}
		?>
	</div>
</div>
	
</div>


<?php include_once("../footer.php") ?>