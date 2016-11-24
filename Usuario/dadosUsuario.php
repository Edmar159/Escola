<?php include_once("../header.php") ?>
<?php include_once("../validar.php") ?>

<?php 

$cod = $_SESSION['cod'];
$tipo = $_SESSION['tipo'];


if($tipo == "professor"){
	$result = mysqli_query($con, "SELECT * FROM professor WHERE codProfessor = '$cod'");

	 

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
								<td><b>Endereço</b></td>
								<td><b>Formação</b></td>
								<td><b>Salário</b></td>
							</tr>
					
					<?php
					while($usuario = mysqli_fetch_object($result))
					{
					?>					
						<td><span class="detalhes"><?php echo $usuario->log_professor ?></span></td>
						<td><span class="detalhes"><?php echo $usuario->nome ?></span></td>
						<td><span class="detalhes"><?php echo $usuario->endereco ?></span></td>
						<td><span class="detalhes"><?php echo $usuario->formacao ?></span></td>
						<td><span class="detalhes"><?php echo $usuario->salario ?></span></td>
					<?php
					}
					?>
					
					<tr>
						<td>
							<p><a href="altProf.php"
							 class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Alterar</a></p>
						</td>
					</tr>
				</table> <?php	
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
	}elseif ($tipo=="aluno") { 
	
		$result = mysqli_query($con, "SELECT * FROM aluno WHERE codAluno = '$cod'");

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
								<td><b>Endereço</b></td>
								<td><b>Curso</b></td>
								<td><b>Data de nascimento</b></td>
							</tr>
					
					<?php
					while($usuario = mysqli_fetch_object($result))
					{
					?>					
						<td><span class="detalhes"><?php echo $usuario->log_aluno ?></span></td>
						<td><span class="detalhes"><?php echo $usuario->nome ?></span></td>
						<td><span class="detalhes"><?php echo $usuario->endereco ?></span></td>
						<td><span class="detalhes"><?php echo $usuario->curso ?></span></td>
						<td><span class="detalhes"><?php echo $usuario->dataNasc ?></span></td>
					<?php
					}
					?>
					
					<tr>
						<td class="col-md-1 col-md-offset-9">
							<p><a href="altAlun.php"
							 class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Alterar</a></p>
						</td>
					</tr>
				</table> <?php	
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
	
	<?php } ?>



<?php include_once("../footer.php") ?>