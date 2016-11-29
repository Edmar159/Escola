<?php include_once("../header.php") ?>
<?php include_once("../validar.php") ?>

<?php 

$cod = $_SESSION['cod'];
$tipo = $_SESSION['tipo'];
$codT = $_GET['codT'];
if(isset($_GET['codA']))
	$codA=$_GET['codA'];

if($tipo == "professor"){

$result = mysqli_query($con, "SELECT * FROM avaliacao_aluno where codAluno = '$codA'");		
if($cond = mysqli_fetch_object($result)){
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
									
								</tr>
								<?php
								$media = $aux = 0;
								$result = mysqli_query($con, "SELECT * FROM turma where codTurma = '$codT'");
								$turma = mysqli_fetch_object($result);
								$result = mysqli_query($con, "SELECT * FROM avaliacao where codTurma = '$turma->codTurma'");
								while($usuario = mysqli_fetch_object($result))
								{
									$res = mysqli_query($con, "SELECT * FROM avaliacao_aluno where codAvaliacao = '$usuario->codAvaliacao' and codAluno = '$codA' ");
									if(mysqli_num_rows($res) > 0){
										$ava_aluno = mysqli_fetch_object($res);
										$res = mysqli_query($con, "SELECT * FROM avaliacao where codAvaliacao = '$ava_aluno->codAvaliacao' ");
										$aval_global = mysqli_fetch_object($res);
										$res = mysqli_query($con, "SELECT * FROM turma where codTurma = '$aval_global->codTurma'");
										$turma = mysqli_fetch_object($res);
										$res = mysqli_query($con, "SELECT * FROM professor where codProfessor = '$turma->codProfessor'");
										$prof = mysqli_fetch_object($res);
										$res = mysqli_query($con, "SELECT * FROM disciplina where codDisciplina = '$turma->codDisciplina'");
										$disc = mysqli_fetch_object($res);

										?>
										<tr>
											<td><span class="detalhes"><?php echo $disc->curso ?></a></span><br></td>
											<td><span class="detalhes"><?php echo $prof->nome ?></a></span><br></td>
											<td><span class="detalhes"><?php echo $ava_aluno->nota ?></a></span><br>
											<td></td>
											</td>
										</tr>
										
										<?php
										$aux++;
										$media = $media + $ava_aluno->nota;
									}
								}

							?>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td>
									
									<?php
										if($aux != 0){ ?>
										<span class="detalhes"><?php $media=$media/$aux; echo round($media,2) ?></a></span><br>
									<?php }?>
									</td>
									
								</tr>	
							</table>
						</div> 
							<a href="javascript:history.back()">Voltar</a>
						<?php	
						}
					}
				}else{
					echo("Aluno não realizou nenhuma avaliação até o momento!");
				}
		
	}elseif ($tipo=="aluno") { 
	
		$result = mysqli_query($con, "SELECT * FROM aluno WHERE codAluno = '$cod'");
		 
	if($tipo == "aluno"){
	$result = mysqli_query($con, "SELECT * FROM avaliacao_aluno where codAluno = '$cod'");		
	if($cond = mysqli_fetch_object($result))
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
								$result = mysqli_query($con, "SELECT * FROM avaliacao where codTurma = '$turma->codTurma'");
								while($usuario = mysqli_fetch_object($result))
								{
									$res = mysqli_query($con, "SELECT * FROM avaliacao_aluno where codAvaliacao = '$usuario->codAvaliacao' and codAluno = '$cod' ");
									if(mysqli_num_rows($res) > 0){
										$ava_aluno = mysqli_fetch_object($res);
										$res = mysqli_query($con, "SELECT * FROM avaliacao where codAvaliacao = '$ava_aluno->codAvaliacao' ");
										$aval_global = mysqli_fetch_object($res);
										$res = mysqli_query($con, "SELECT * FROM turma where codTurma = '$aval_global->codTurma'");
										$turma = mysqli_fetch_object($res);
										$res = mysqli_query($con, "SELECT * FROM professor where codProfessor = '$turma->codProfessor'");
										$prof = mysqli_fetch_object($res);
										$res = mysqli_query($con, "SELECT * FROM disciplina where codDisciplina = '$turma->codDisciplina'");
										$disc = mysqli_fetch_object($res);

										?>
										<tr>
											<td><span class="detalhes"><?php echo $disc->curso ?></a></span><br></td>
											<td><span class="detalhes"><?php echo $prof->nome ?></a></span><br></td>
											<td><span class="detalhes"><?php echo $ava_aluno->nota ?></a></span><br>
											<td></td>
											<td></td>
											</td>
										</tr>
										
										<?php
										$aux++;
										$media = $media + $ava_aluno->nota;
									}
								}
								if($aux != 0){
									$media=$media/$aux;
									$media = round($media,2);
									$rez=mysqli_query($con, "SELECT * FROM matricula where codAluno='$cod' and codTurma ='$codT'");
									if($mat= mysqli_fetch_object($rez)){
										mysqli_query($con, "UPDATE matricula set media = '$media' where codAluno='$cod' and codTurma ='$codT'");
									}else{
										mysqli_query($con, "INSERT into matricula (media) VALUES ('$media') where codAluno='$cod' and codTurma ='$codT'");
										
									}
								}
							?>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td><?php if($aux >0){?>
										<span class="detalhes"><?php echo $media ?></a></span><br>
										<?php
									}?>
									</td>
									<td></td>
								</tr>	
							</table>
						</div> <?php	
						}
					}
					?>
					<div class="panel panel-primary">
			  			<div class="panel-heading">Avaliações Pendentes</div>
						<table class="table table-striped">
							<tr>
								<td><b>Disciplina</b></td>
								<td><b>Professor</b></td>
								<td></td>
							</tr>
							<?php
							$result = mysqli_query($con, "SELECT * FROM turma where codTurma = '$codT'");
							$turma = mysqli_fetch_object($result);
							$result = mysqli_query($con, "SELECT curso FROM disciplina where codDisciplina = '$turma->codDisciplina'");
							$disc = mysqli_fetch_object($result);
							$result = mysqli_query($con, "SELECT nome FROM professor where codProfessor = '$turma->codProfessor'");
							$prof = mysqli_fetch_object($result);
							$result = mysqli_query($con, "SELECT * FROM avaliacao where codTurma = '$turma->codTurma'");
							while($aval = mysqli_fetch_object($result)){
								$resul = mysqli_query($con, "SELECT * FROM avaliacao_aluno where codAvaliacao = '$aval->codAvaliacao' and codAluno = '$cod'");
								if($ava_aluno = mysqli_fetch_object($resul)){

								}else{ ?>
									
										<tr>
											<td><a href="../Prova/Prova.php?codA=<?php echo $aval->codAvaliacao ?>"><span class="detalhes"><?php echo $disc->curso ?></a></span><br></td>
											<td><a href="../Prova/Prova.php?codA=<?php echo $aval->codAvaliacao ?>"><span class="detalhes"><?php echo $prof->nome ?></a></span><br></td>
											</td>
										</tr>	
									
							<?php
								}	
							}
							?>
						</table>
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