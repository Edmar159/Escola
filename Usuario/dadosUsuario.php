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
						<td></td><td></td><td></td><td></td>
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
		<?php 
				$result = mysqli_query($con, "SELECT * FROM turma where codProfessor = '$cod'");
				if(isset($result))
				{		
					if(mysqli_num_rows($result) > 0)
					{
					
						?>
						
						<div class="panel panel-primary">
			  			<div class="panel-heading"> <b>Disciplinas </b></div>
						<table class="table table-striped">
								<tr>
									<td><b>Curso</b></td>
									<td><b>Ementa</b></td>
									<td></td>
								</tr>
						<?php
						
							while($user = mysqli_fetch_object($result))
							{
								$resul = mysqli_query($con, "SELECT * FROM disciplina where codDisciplina = '$user->codDisciplina'");
								$usuario = mysqli_fetch_object($resul);
								?>
								<tr>
									<td><span class="detalhes"><?php echo $usuario->curso ?></a></span><br></td>
									<td><span class="detalhes"><?php echo $usuario->ementa ?></a></span><br>
									</td>
									</td>
									<td>
								<a class="btn btn-default btn-xs"  href="../Disciplina/altDisc.php?cod=<?php echo $usuario->codDisciplina; ?>"  role="button" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Alterar</a>
									</td>
								
								</tr>
								
								<?php
							}
						?></table> <?php	
					}else
					{		
					?>		
						<p class="bg-info"><b> Nenhuma disciplina encontrado</b></p>				
					<?php
					}
				}
				?>
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
					<td></td><td></td><td></td><td></td>
						<td>
							<p><a href="altAlun.php"
							 class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Alterar</a></p>
						</td>
					</tr>
				</table> 
				<?php	
				}elseif($aux = 0)
				{
				?>		
					<p class="bg-info"><b> Nenhum usuario encontrado</b></p>				
				<?php
				}
			}
			?>
		</div> <?php
		if($tipo == "aluno"){
	$result = mysqli_query($con, "SELECT * FROM matricula where codAluno = '$cod'");		
	?>
		<div class="row ">
			<div class="col-md-12 col-md-offset-0">
					<?php 
					
					if(isset($result))
					{		
						if(mysqli_num_rows($result) > 0)
						{
						
							?>
							
							<div class="panel panel-primary">
				  			<div class="panel-heading">Matrículas Efetuadas</div>
							<table class="table table-striped">
									<tr>
										<td><b>Turma</b></td>
										<td><b>Sala</b></td>
										<td><b>Horario</b></td>
										<td><b>Professor</b></td>
										<td><b>Disciplina</b></td>
										<td></td>
									</tr>
							<?php
							while($usuario = mysqli_fetch_object($result))
							{
								$res = mysqli_query($con, "SELECT * FROM turma where codTurma = '$usuario->codTurma' ");
								$dados = mysqli_fetch_object($res);
								?>
								<tr>
									<td><span class="detalhes"><?php echo $dados->codTurma ?></a></span><br></td>
									<td><span class="detalhes"><?php echo $dados->sala ?></a></span><br></td>
									<td><span class="detalhes"><?php echo $dados->horario ?></a></span><br>
									</td>
									<td><span class="detalhes"><?php $resu = mysqli_query($con,"SELECT nome from professor WHERE codProfessor = '$dados->codProfessor'"); $prof = mysqli_fetch_object($resu); echo $prof->nome;?></a></span><br>
									</td>
									<td><span class="detalhes"><?php $resu = mysqli_query($con,"SELECT curso from disciplina WHERE codDisciplina = '$dados->codDisciplina'"); $prof = mysqli_fetch_object($resu); echo $prof->curso;?></a></span><br>
									</td>
									<td>
									<!--<a class="btn btn-default btn-xs"  href="altTurma.php?cod=<?php // echo $usuario->codTurma; ?>"<!--  role="button" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Alterar</a> -->
									</td>
									
								</tr>
								
								<?php
							}
							?></table> <?php	
						}else
						{		
						?>		
							<p class="bg-info"><b> Nenhuma matricula realizada!</b></p>				
						<?php
						}
					}
					?>
				</div>
			</div>
		</div>
<?php } ?>

	</div>	
	
	<?php }elseif ($tipo=="funcionario") { 
	
		$result = mysqli_query($con, "SELECT * FROM funcionario WHERE codFuncionario = '$cod'");

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
							</tr>
					
					<?php
					while($usuario = mysqli_fetch_object($result))
					{
					?>					
						<td><span class="detalhes"><?php echo $usuario->log_func ?></span></td>
						<td><span class="detalhes"><?php echo $usuario->nome ?></span></td>
						<?php
					}
					?>
					
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