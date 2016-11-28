<?php include_once("../header.php") ?>
<?php include_once("../validar.php") ?>

<?php 

		if(isset($_GET['success']))
		{
			?> 
				<p class="bg-success" style="color:green"><?php echo $_GET['success'] ?></p>
			<?php
		}
		if(isset($_GET['cod']))
			$codT = $_GET['cod'];
	?>
<?php

if(isset($_GET['busca']))
{	
	$busca = $_GET['busca'];
	if ($busca == NULL){
		$result = mysqli_query($con, "SELECT * FROM turma");
	}
	else{
		$result = mysqli_query($con, "SELECT * FROM professor WHERE nome like '%$busca%'");
		if(isset($result)){
			if(mysqli_num_rows($result) > 0)
			{
				$prof= mysqli_fetch_object($result);
				$result = mysqli_query($con, "SELECT * FROM turma WHERE codProfessor = '$prof->codProfessor'");		
			}else{
				$busca = strtoupper($busca);
				$result = mysqli_query($con, "SELECT * FROM disciplina WHERE curso like '%$busca%'");
				if(isset($result)){
					if(mysqli_num_rows($result) > 0)
					{
						$disc= mysqli_fetch_object($result);
						$result = mysqli_query($con, "SELECT * FROM turma WHERE codDisciplina = '$disc->codDisciplina'");		
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
					<h3 class="panel-title">Consultar Turma</h3>
			</div>
			<div class="panel-body">
			<form class="form-horizontal" method="GET" action="buscaTurma.php" >
					<div class="form-group">
						<div class="col-md-1 col-md-offset-0">
					    	<label class="control-label">Busca</label>
						</div>
						<div class="col-md-9">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
							   	<input type="text" class="form-control" name="busca" placeholder="Professor ou Disciplina" aria-describedby="basic-addon1">
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
									<td><b>Professor</b></td>
									<td><b>Disciplina</b></td>
									<td></td>
								</tr>
						<?php
						while($usuario = mysqli_fetch_object($result))
						{
							?>
							<tr>
								<td><span class="detalhes"><?php $resu = mysqli_query($con,"SELECT nome from professor WHERE codProfessor = '$usuario->codProfessor'"); $prof = mysqli_fetch_object($resu); echo $prof->nome;?></a></span><br>
								</td>
								<td><span class="detalhes"><?php $resu = mysqli_query($con,"SELECT curso from disciplina WHERE codDisciplina = '$usuario->codDisciplina'"); $prof = mysqli_fetch_object($resu); echo $prof->curso;?></a></span><br>
								</td>
								<td>
								<a class="btn btn-default btn-xs"  href="altTurma.php?cod=<?php echo $usuario->codTurma; ?>"  role="button" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Alterar</a>
								</td>
								
							</tr>
							
							<?php
						}
						?></table> <?php	
					}else
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