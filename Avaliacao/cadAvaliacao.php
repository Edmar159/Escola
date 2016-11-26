<?php include_once("../header.php") ?>

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
					<h3 class="panel-title">Cadastrar Avaliação</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="cadasAval.php" >
					<div class="form-group">
				    	<label class="col-md-3	 control-label">*Turma</label>
						<div class="col-md-8">
							<select class="form-control" name="turma">
								<?php
								$result = mysqli_query($con, "SELECT * FROM turma");
							 	while($turma = mysqli_fetch_object($result)){
							 		$result1 = mysqli_query($con, "SELECT * FROM disciplina WHERE codDisciplina = '$turma->codDisciplina'");
							 		$disc = mysqli_fetch_object($result1);
							 		$result2 = mysqli_query($con, "SELECT * FROM professor WHERE codProfessor = '$turma->codProfessor'");
							 		$prof = mysqli_fetch_object($result2)
							 ?>
									<option value="<?php echo $turma->codTurma?>">Curso :<?php echo $disc->curso ?> Professor <?php echo $prof->nome ?></option>  
								<?php } ?> 
							</select>
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3 control-label">*Quantidade de Questões</label>
						<div class="col-md-8">
						   	<input type="text" class="form-control" name="qtquest" placeholder="8">
						</div>
					</div>
					<div class="form-group">
					    <div class="col-md-9 col-md-offset-3">
						   	<p class="text-danger">(*) campos de preenchimento obrigatório</p>
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