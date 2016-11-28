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

$aux =0;
$cod = $_SESSION['cod'];;
if($tipo == "funcionario"){
	if(isset($_GET['busca']))
	{	
		$busca = $_GET['busca'];
		if ($busca == NULL){
				$result = mysqli_query($con, "SELECT aluno.*,matricula.* FROM aluno LEFT JOIN matricula ON aluno.codAluno = matricula.codAluno");			
		}else 
		{
			$result = mysqli_query($con, "SELECT * FROM aluno WHERE nome like '%$busca%'");
			if(isset($result)){
				if(mysqli_num_rows($result)>0){
					$alun = mysqli_fetch_object($result);
					$result = mysqli_query($con, "SELECT aluno.*,matricula.* FROM aluno LEFT JOIN matricula ON aluno.codAluno = matricula.codAluno where aluno.nome like '%$busca%'");

				}else{
				$result = mysqli_query($con, "SELECT * FROM matricula WHERE codTurma like '%$busca%'");
				if(isset($result)){
					if(mysqli_num_rows($result)>0){
						$alun = mysqli_fetch_object($result);
						$result = mysqli_query($con, "SELECT aluno.*,matricula.* FROM aluno LEFT JOIN matricula ON aluno.codAluno = matricula.codAluno where matricula.codTurma = '$busca'");
						$aux = 1;
						
					}
				}	
			}
			}
		}
	}
		
	

	?>
	<div class="row">
		 <div class="row col-md-12 col-md-offset-0">    	
		   	<div class="panel panel-primary">
				<div class="panel-heading">
						<h3 class="panel-title">Matriculas Efetuadas</h3>
				</div>
				<div class="panel-body">
				<form class="form-horizontal" method="GET" action="buscaMat.php" >
						<div class="form-group">
							<div class="col-md-1 col-md-offset-0">
						    	<label class="control-label">Busca</label>
							</div>
							<div class="col-md-9">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
								   	<input type="text" class="form-control" name="busca" placeholder="Aluno \ Codigo Turma" aria-describedby="basic-addon1">
							   	</div>
							</div>
							<div class="col-md-1">
								<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>
							</div>
						</div>
				</form>
				</div>
			</div>
		</div>
	</div>
		<div class="row ">
			<div class="col-md-12 col-md-offset-0">
					<?php 
					
					if(isset($result))
					{		
						if(mysqli_num_rows($result) > 0)
						{
						
							?>
							
							<div class="panel panel-primary">
				  			<div class="panel-heading">Turmas</div>
							<table class="table table-striped">
									<tr>
										<td class="col-md-1"><b>Turma</b></td>
										<td class="col-md-1"><b>Professor</b></td>
										<td class="col-md-1"><b>Aluno</b></td>
										<td class="col-md-1"><b>Disciplina</b></td>
										<td class="col-md-1"></td>
									</tr>
							<?php

							
							while($usuario = mysqli_fetch_object($result))
							{
								$res = mysqli_query($con, "SELECT * FROM turma where codTurma = '$usuario->codTurma' ");
								$dados = mysqli_fetch_object($res);
								?>
								<tr>
									<td><span class="detalhes"><?php echo $dados->codTurma ?></a></span><br></td>
									
									<td><span class="detalhes"><?php $resu = mysqli_query($con,"SELECT nome from professor WHERE codProfessor = '$dados->codProfessor'"); $prof = mysqli_fetch_object($resu); echo $prof->nome;?></a></span><br>
									</td>
									<td><span class="detalhes"><?php  echo $usuario->nome;?></a></span><br>
									</td>
									<td><span class="detalhes"><?php $resu = mysqli_query($con,"SELECT curso from disciplina WHERE codDisciplina = '$dados->codDisciplina'"); $prof = mysqli_fetch_object($resu); echo $prof->curso;?></a></span><br>
									</td>
									<td>
									<?php 
										$rez = mysqli_query($con, "SELECT * from matricula where codTurma = '$usuario->codTurma'");
									?>
									<a class="btn btn-default btn-xs" <?php if($cond = mysqli_fetch_object($rez)){?> disabled <?php }else{ ?> href="desativarMat.php?codT=<?php echo $dados->codTurma; ?>&codA=<?php echo $alun->codAluno ?>"  <?php }?>role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir</a>

									<a class="btn btn-default btn-xs"  href="desativarMat.php?codT=<?php echo $dados->codTurma; ?>&codA=<?php echo $alun->codAluno ?>"  role="button" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir</a> 
									</td>
									
								</tr>
								<?php if($aux == 1){
								?>
								<tr>
									<td></td><td></td><td><span class="detalhes"><b>Alunos Matriculados</span></td><td></td><td></td>
								</tr>
	
								<?php $result = mysqli_query($con, "SELECT * FROM matricula where codTurma = '$alun->codTurma'");
								while($rer=mysqli_fetch_object($result)){
									 ?><tr><td></td><td></td><td><span class="detalhes"><?php $ret = mysqli_query($con,"SELECT nome from aluno WHERE codAluno = '$rer->codAluno'"); $prof = mysqli_fetch_object($ret);  echo $prof->nome;?></a></span><br></td><td></td><td></td> </tr> 
									<?php
									}			
								}
								
								
							}
						
							?></table> <?php	
						}else
						{		
						?>		
							<p class="bg-info"><b> Nenhum aluno encontrado</b></p>				
						<?php
						}
					}
					?>
				</div>
			</div>
		</div>
<?php } 
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
									<td><a href="../Disciplina/dadosDisciplina.php?codT=<?php echo $dados->codTurma?>"><span class="detalhes"><?php echo $dados->codTurma ?></a></span></a><br></td>
									<td><a href="../Disciplina/dadosDisciplina.php?codT=<?php echo $dados->codTurma?>"><span class="detalhes"><?php $resu = mysqli_query($con,"SELECT nome from professor WHERE codProfessor = '$dados->codProfessor'"); $prof = mysqli_fetch_object($resu); echo $prof->nome;?></a></span></a><br>
									</td>
									<td><a href="../Disciplina/dadosDisciplina.php?codT=<?php echo $dados->codTurma?>"><span class="detalhes"><?php $resu = mysqli_query($con,"SELECT curso from disciplina WHERE codDisciplina = '$dados->codDisciplina'"); $prof = mysqli_fetch_object($resu); echo $prof->curso;?></a></span></a><br>
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

<?php include_once("../footer.php") ?>