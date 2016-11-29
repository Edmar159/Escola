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

	$result = mysqli_query($con, "SELECT turma.*, avaliacao.*, disciplina.*, prova.* FROM turma LEFT JOIN avaliacao on turma.codTurma = avaliacao.codTurma LEFT JOIN disciplina on turma.codDisciplina = disciplina.codDisciplina LEFT JOIN prova ON avaliacao.codAvaliacao = prova.codAvaliacao WHERE turma.codProfessor = '$cod' GROUP BY avaliacao.codAvaliacao");
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
								if($user->codAvaliacao != NULL){
									?>
									<tr>
										<td><span class="detalhes"><?php echo $user->curso ?></a></span><br></td>
										<td><span class="detalhes"><?php echo $user->nroQuestoes ?></a></span><br></td>
										<td><?php
										$resu = mysqli_query($con, "SELECT * from avaliacao_aluno where codAvaliacao = '$user->codAvaliacao'");
										?>		
											<a class="btn btn-default btn-xs" <?php if($cond = mysqli_fetch_object($resu)){?> disabled <?php }else{ ?> href="altAval.php?cod=<?php echo $user->codAvaliacao; ?>"  <?php }?> role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Alterar</a>
										</td>
										<td><?php
										$resu = mysqli_query($con, "SELECT * from avaliacao_aluno where codAvaliacao = '$user->codAvaliacao'");
										?>
											<a class="btn btn-default btn-xs" <?php if($cond = mysqli_fetch_object($resu)){?> disabled <?php }else{ ?> href="deleteAval.php?cod=<?php echo $user->codAvaliacao; ?>"  <?php }?>role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir</a> 
										</td>
									
									</tr>
									
								<?php 
								 
								}
							}
						
						?></table> <?php		
					}else
					{		
					?>		
						<p class="bg-info"><b> Nenhuma avaliação cadastrada!</b></p>				
					<?php
					}
				}else
					{		
					?>		
						<p class="bg-info"><b> Nenhuma avaliação cadastrada!</b></p>				
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