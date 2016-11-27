<?php include_once("../header.php") ?>
<?php include_once("../validar.php") ?>

<?php 

$cod = $_SESSION['cod'];
$tipo = $_SESSION['tipo'];
$codT = $_GET['codT'];

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
						<p class="bg-info"><b> Você não possui nenhuma disciplina cadastrada!</b></p>				
					<?php
					}
				}
				?>
	</div>
<?php
	}elseif ($tipo=="aluno") { 
	
		$result = mysqli_query($con, "SELECT * FROM aluno WHERE codAluno = '$cod'");
		 
	if($tipo == "aluno"){
	$result = mysqli_query($con, "SELECT * FROM avaliacao_aluno where codAluno = '$cod'");		
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
				  			<div class="panel-heading">Avaliações Realizadas</div>
							<table class="table table-striped">
								<tr>
									<td><b>Disciplina</b></td>
									<td><b>Professor</b></td>
									<td><b>Nota</b></td>
									<td><b>Média </b></td>
									<td></td>
								</tr>
								<?php
								$media = $aux = 0;
								$result = mysqli_query($con, "SELECT * FROM turma where codTurma = '$codT'");
								$turma = mysqli_fetch_object($result);
								$result = mysqli_query($con, "SELECT * FROM avaliacao where codAvaliacao = '$turma->codAvaliacao'");
								while($usuario = mysqli_fetch_object($result))
								{
									$res = mysqli_query($con, "SELECT * FROM avaliacao_aluno where codAvaliacao = '$usuario->codAvaliacao' and codAluno = '$cod' ");
									$ava_aluno = mysqli_fetch_object($res);
									$res = mysqli_query($con, "SELECT * FROM avaliacao where codAvaliacao = '$ava_aluno->codAvaliacao' ");
									$aval_global = mysqli_fetch_object($res);
									$res = mysqli_query($con, "SELECT * FROM turma where codTruma = '$aval_global->codTurma'");
									$turma = mysqli_fetch_object($$res);
									$res = mysqli_query($con, "SELECT * FROM professor where codProfessor = '$turma->codProfessor'");
									$prof = mysqli_fetch_object($$res);
									$res = mysqli_query($con, "SELECT * FROM disciplina where codDisciplina = '$turma->codDisciplina'");
									$disc = mysqli_fetch_object($$res);

									?>
									<tr>
										<td><span class="detalhes"><?php echo $disc->curso ?></a></span><br></td>
										<td><span class="detalhes"><?php echo $prof->nome ?></a></span><br></td>
										<td><span class="detalhes"><?php echo $aval_aluno->nota ?></a></span><br>
										</td>
									</tr>
									
									<?php
									$aux++;
									$media = $media + $ava_aluno->nota;
								}

							?>
								<tr>
									<td>
										<span class="detalhes"><?php $media/$aux ?></a></span><br>
									</td>
								</tr>	
							</table> <?php	
						}
					// SELECIONAR AS AVALIAÇÕES CADASTRADAS PARA A TURMA QUE O ALUNO ESTÁ CADASTRADO E AINDA NÃO EFETUOU, ENVIAR ISSO PARA PAG DA PROVA
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