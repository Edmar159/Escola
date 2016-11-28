<?php include_once("../header.php") ?>
<?php include_once("../conexao.php") ?>

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
    <div class="col-md-12 col-md-offset-0">    	
	   	<div class="panel panel-primary">
			<div class="panel-heading">
					<h3 class="panel-title">Cadastrar Turma</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="storeTurma.php" >
					<div class="form-group">
					    <label class="col-md-3	 control-label">*Professor</label>
						<div class="col-md-9">
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
						<div class="col-md-9">
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
					    <div class="col-md-2 col-md-offset-10">
					      <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Cadastrar</button>
					    </div>
					</div>
				</form>
				<div class="row">

				</div>
			</div>
		</div>
    </div>

<?php include_once("../footer.php") ?>