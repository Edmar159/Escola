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

if($tipo == "professor"){
	$cod=$_SESSION['cod'];	

	$result = mysqli_query($con, "SELECT * FROM turma where codProfessor = '$cod'");
	//$temp = mysqli_fetch_object($result);
	//$result = mysqli_query($con, "SELECT * FROM disciplina where codDisciplina = '$temp->codDisciplina'");

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
			  			<div class="panel-heading"> <b>Avaliações </b></div>
						<table class="table table-striped">
								<tr>
									<td><b>Disciplina</b></td>
									<td><b>Numero de questões</b></td>
									<td></td>
									<td></td>
								</tr>
						<?php
						
							while($user = mysqli_fetch_object($result))
							{
								$resul = mysqli_query($con, "SELECT * FROM disciplina where codDisciplina = '$user->codDisciplina'");
								$disc = mysqli_fetch_object($resul);
								$resul = mysqli_query($con, "SELECT * FROM avaliacao where codTurma = '$user->codTurma'");
								while($aval = mysqli_fetch_object($resul)){
									$resul10 =mysqli_query($con, "SELECT * from prova where codAvaliacao='$aval->codAvaliacao'");
									if($prova = mysqli_fetch_object($resul10)){
										?>
										<tr>
											<td><span class="detalhes"><?php echo $disc->curso ?></a></span><br></td>
											<td><span class="detalhes"><?php echo $aval->nroQuestoes ?></a></span><br></td>
											<td><?php
											$result = mysqli_query($con, "SELECT * from avaliacao_aluno where codAvaliacao = '$aval->codAvaliacao'");
											?>		
												<a class="btn btn-default btn-xs" <?php if($cond = mysqli_fetch_object($result)){?> disabled <?php }else{ ?> href="altAval.php?cod=<?php echo $aval->codAvaliacao; ?>" role="button"> <?php }?><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Alterar</a>
											</td>
											<td><?php
											$result = mysqli_query($con, "SELECT * from avaliacao_aluno where codAvaliacao = '$aval->codAvaliacao'");
											?>
												<a class="btn btn-default btn-xs" <?php if($cond = mysqli_fetch_object($result)){?> disabled <?php }else{ ?> href="deleteAval.php?cod=<?php echo $aval->codAvaliacao; ?>" role="button"> <?php }?><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir</a> 
											</td>
										
										</tr>
										
									<?php
									}
								}
							}
						
						?></table> <?php		
					}
				}else
					{		
					?>		
						<p class="bg-info"><b> Você não possui nenhuma disciplina cadastrada!</b></p>				
					<?php
					}
				?>
			</div>
		</div>
	</div>
<?php
	}else{
		echo ("Você não possui permissão");
	}
?>


<?php include_once("../footer.php") ?>