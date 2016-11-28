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
		$result = mysqli_query($con, "SELECT * FROM turma WHERE codTurma = '$cod'");
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
				<form class="form-horizontal" method="POST" action="updateTurma.php" >
						
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Dados da turma</h3>				
					</div>
					<div class="panel-body">
						<div class="form-group">
						    <label class="col-md-3	 control-label">*Professor</label>
							<div class="col-md-8">
							<select class="form-control" name="professor">
							<?php
								$result = mysqli_query($con, "SELECT * FROM professor");
							 	while($professor = mysqli_fetch_object($result)){
							 ?>
									<option value="<?php echo $professor->codProfessor?>"><?php echo $professor->nome ?></option>  
								<?php } ?>
							</select>
							</div>
						</div>
						<div class="form-group">
					    	<label class="col-md-3	 control-label">*Disciplina</label>
							<div class="col-md-8">
							<select class="form-control" name="disciplina">
									<?php
								$result = mysqli_query($con, "SELECT * FROM disciplina");
							 	while($disciplina = mysqli_fetch_object($result)){
							 ?>
									<option value="<?php echo $disciplina->codDisciplina?>"><?php echo $disciplina->curso ?></option>  
								<?php } ?> 
							</select>
						</div>
					</div>
							
							<div class="form-group">
					    		<div class="col-md-1 col-md-offset-9">
					    		<input type="hidden" class="form-control" name="codi" value="<?php echo $usuario->codTurma ?>" >
									<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true" style="width:15px"></span> Atualizar</button>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-1 col-md-offset-9">
						    		
								<!--	<a class="btn btn-default btn"  href="desativarTurma.php?cod=<?php// echo $usuario->codTurma ?>" <!--  role="button" ><span class="glyphicon glyphicon-trash" aria-hidden="true" style="width:25px"></span> Deletar</a> -->
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
