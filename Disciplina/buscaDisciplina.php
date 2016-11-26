<?php include_once("../header.php") ?>
<?php include_once("../validar.php") ?>

<?php
$aux = 0;
if($tipo == "funcionario"){
if(isset($_GET['busca']))
{	
	$busca = $_GET['busca'];
	if ($busca == NULL)
	{
		$result = mysqli_query($con, "SELECT * FROM disciplina");

	}
	else
	{
		$result = mysqli_query($con, "SELECT * FROM disciplina WHERE curso like '%$busca%' or ementa like '%$busca%'");
	}
}

?>
<div class="row">
	 <div class="row col-md-12 col-md-offset-0">    	
	   	<div class="panel panel-primary">
			<div class="panel-heading">
					<h3 class="panel-title">Consultar Disciplina</h3>
			</div>
			<div class="panel-body">
			<form class="form-horizontal" method="GET" action="buscaDisciplina.php" >
					<div class="form-group">
						<div class="col-md-1 col-md-offset-0">
					    	<label class="control-label">Busca</label>
						</div>
						<div class="col-md-9">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
							   	<input type="text" class="form-control" name="busca" placeholder="Curso ou ementa" aria-describedby="basic-addon1">
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
			  			<div class="panel-heading"> <b>Disciplinas </b></div>
						<table class="table table-striped">
								<tr>
									<td><b>Curso</b></td>
									<td><b>Ementa</b></td>
									<td></td>
								</tr>
						<?php
						while($usuario = mysqli_fetch_object($result))
						{
							?>
							<tr>
								<td><span class="detalhes"><?php echo $usuario->curso ?></a></span><br></td>
								<td><span class="detalhes"><?php echo $usuario->ementa ?></a></span><br>
								</td>
								</td>
								<td>
							<a class="btn btn-default btn-xs"  href="altDisc.php?cod=<?php echo $usuario->codDisciplina; ?>"  role="button" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Alterar</a>
								</td>
							
							</tr>
							
							<?php
						}
						?></table> <?php	
					}else
					{		
					?>		
						<p class="bg-info"><b> Nenhuma disciplina encontrada!</b></p>				
					<?php
					}
				}
				?>
			</div>
		</div>
	</div>
<?php }
if($tipo == "professor"){
	$aux = 0;	
	if(isset($_GET['busca']))
	{	
		$busca = $_GET['busca'];
		if ($busca == NULL)
		{
			$result = mysqli_query($con, "SELECT * FROM turma where codProfessor = '$cod'");
			//$temp = mysqli_fetch_object($result);
			//$result = mysqli_query($con, "SELECT * FROM disciplina where codDisciplina = '$temp->codDisciplina'");
			$aux = 1;
		}
		else
		{
			$result = mysqli_query($con, "SELECT * FROM turma where codProfessor = '$cod'");
			//$temp = mysqli_fetch_object($result);
			
			//$result = mysqli_query($con, "SELECT * FROM disciplina WHERE codDisciplina = '$temp->codDisciplina' and curso like '%$busca%' or ementa like '%$busca%'");
		}
	}

?>
<div class="row">
	 <div class="row col-md-12 col-md-offset-0">    	
	   	<div class="panel panel-primary">
			<div class="panel-heading">
					<h3 class="panel-title">Consultar Disciplina</h3>
			</div>
			<div class="panel-body">
			<form class="form-horizontal" method="GET" action="buscaDisciplina.php" >
					<div class="form-group">
						<div class="col-md-1 col-md-offset-0">
					    	<label class="control-label">Busca</label>
						</div>
						<div class="col-md-9">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
							   	<input type="text" class="form-control" name="busca" placeholder="Curso ou ementa" aria-describedby="basic-addon1">
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
			  			<div class="panel-heading"> <b>Disciplinas </b></div>
						<table class="table table-striped">
								<tr>
									<td><b>Curso</b></td>
									<td><b>Ementa</b></td>
									<td></td>
								</tr>
						<?php
						if($aux == 1){
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
								<!--<a class="btn btn-default btn-xs"  href="altDisc.php?cod=<?php //echo $usuario->codDisciplina; ?>" <!--  role="button" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Alterar</a> -->
									</td>
								
								</tr>
								
								<?php
							}
						}elseif($aux == 0){
							while($user = mysqli_fetch_object($result))
							{
								$resul = mysqli_query($con, "SELECT * FROM disciplina where codDisciplina = '$user->codDisciplina' and (ementa like '%$busca%' or curso like '%$busca%')");
								if(mysqli_num_rows($resul) >0){
								$usuario = mysqli_fetch_object($resul);
								?>
								<tr>
									<td><span class="detalhes"><?php echo $usuario->curso ?></a></span><br></td>
									<td><span class="detalhes"><?php echo $usuario->ementa ?></a></span><br>
									</td>
									</td>
									<td>
								<!--<a class="btn btn-default btn-xs"  href="altDisc.php?cod=<?php // echo $usuario->codDisciplina; ?>" <!-- role="button" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Alterar</a> -->
									</td>
								
								</tr>
								
								<?php
							}
						}

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
		</div>
	</div>
<?php
	}
?>


<?php include_once("../footer.php") ?>