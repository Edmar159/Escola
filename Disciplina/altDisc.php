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
$cod = $_GET['cod'];
if( $_SESSION["tipo"] == "funcionario"){
		$result = mysqli_query($con, "SELECT * FROM disciplina WHERE codDisciplina = '$cod'");


?>
	<?php 
	$aux =0;
	if(isset($result))
	{		
		if(mysqli_num_rows($result) > 0)
		{
			?>
			<div class="col-md-12 col-md-offset-0">
				<?php
				if($usuario = mysqli_fetch_object($result))
				{
					?>
				<form class="form-horizontal" method="POST" action="updateDisciplina.php" >
						
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Dados da disciplina</h3>				
					</div>
					<div class="panel-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Curso</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="nome" placeholder="<?php echo $usuario->curso ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Ementa</label>
								<div class="col-md-8">
								<input type="text" class="form-control" name="ementa" placeholder="<?php echo $usuario->ementa ?>">
								</div>
							</div>
							
							<div class="form-group">
					    		<div class="col-md-1 col-md-offset-9">
					    		<input type="hidden" class="form-control" name="codi" value="<?php echo $usuario->codDisciplina ?>" >
									<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Atualizar</button>
								</div>
							</div>
					</div>
					</div>

			</form>
				<?php
				}
				?>
			</div>
			<?php	
		}
		
	}
}
	

if( $_SESSION["tipo"] == "professor"){
		$result = mysqli_query($con, "SELECT * FROM disciplina WHERE codDisciplina = '$cod'");
?>
	<?php 
	$aux =0;
	if(isset($result))
	{		
		if(mysqli_num_rows($result) > 0)
		{
			?>
			<div class="col-md-12 col-md-offset-0">
				<?php
				if($usuario = mysqli_fetch_object($result))
				{
					?>
				<form class="form-horizontal" method="POST" action="updateDisciplina.php" >
						
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Dados da disciplina</h3>				
					</div>
					<div class="panel-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Curso</label>
								<div class="col-md-8">
									<label><?php echo $usuario->curso ?></label>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Ementa</label>
								<div class="col-md-8">
								<input type="text" class="form-control" name="senha" placeholder="<?php echo $usuario->ementa ?>">
								</div>
							</div>
							
							<div class="form-group">
					    		<div class="col-md-1 col-md-offset-9">
									<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Atualizar</button>
								</div>
							</div>
					</div>
					</div>

			</form>
				<?php
				}
				?>
			</div>
			<?php	
		}
		
	}
}
	
?>

<?php include_once("../footer.php") ?>
