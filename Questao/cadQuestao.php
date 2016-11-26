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

	if($_SESSION['tipo'] == "professor"){
		$codP = $_SESSION['cod'];
		$result = mysqli_query($con, "SELECT * FROM turma where codProfessor = '$codP'");
		if($res = mysqli_fetch_object($result)){
	
	?>

</div>
    <div class="col-md-12 col-md-offset-0">    	
	   	<div class="panel panel-primary">
			<div class="panel-heading">
					<h3 class="panel-title">Cadastrar Questao</h3>
			</div>
			
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="storeQuestao.php" >
					<div class="form-group">
					    <label class="col-md-3	 control-label">*Turma</label>
						<div class="col-md-9">
							<select class="form-control" name="turma">
							<?php
								$result = mysqli_query($con, "SELECT * FROM turma where codProfessor = '$codP'");
							 	while($turm = mysqli_fetch_object($result)){
							 		$resul = mysqli_query($con, "SELECT * FROM disciplina where codDisciplina = '$turm->codDisciplina'");
							 		$disc = mysqli_fetch_object($resul);
							 ?>
									<option value="<?php echo $disc->codDisciplina?>"><?php echo $disc->curso ?></option>  
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3 control-label">*Enunciado</label>
						<div class="col-md-9">
						   	<input type="text" class="form-control" name="enunciado" placeholder="Enunciado">
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3 control-label">*Resposta correta</label>
						<div class="col-md-9">
						   	<input type="text" class="form-control" name="respc" placeholder="Resposta Correta">
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3	 control-label">*Resposta 2</label>
						<div class="col-md-9">
						   	<input type="text" class="form-control" name="resp2" placeholder="Resposta">
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3	 control-label">*Resposta 3</label>
						<div class="col-md-9">
						   	<input type="text" class="form-control" name="resp3" placeholder="Resposta">
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3	 control-label">*Resposta 4</label>
						<div class="col-md-9">
						   	<input type="text" class="form-control" name="resp4" placeholder="Resposta">
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
<?php }else{ echo "Você não possui turmas cadastradas!";
	}
 } ?>

<?php include_once("../footer.php") ?>