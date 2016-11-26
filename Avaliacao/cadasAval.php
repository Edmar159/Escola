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
<?php
	$turma= $_POST['turma']; //cod turma
	$qtques= $_POST['qtquest'];
	$aux = 0;
	$result =mysqli_query($con, "SELECT * FROM turma where codTurma = '$turma'");
	$tur = mysqli_fetch_object($result);
	$result = mysqli_query($con, "SELECT count(*) as total FROM questao where codDisciplina='$tur->codDisciplina'");
	$valida = mysqli_fetch_assoc($result);
	$val = $valida['total'];
	if($val >= $qtques){
		mysqli_query($con, "INSERT into avaliacao (nroQuestoes, codTurma) VALUES('$qtques','$turma')");
		$result = mysqli_query($con, "SELECT MAX(codAvaliacao) as ultimo FROM avaliacao");
		$codA = mysqli_fetch_assoc($result);
		$result =mysqli_query($con, "SELECT * FROM disciplina where codDisciplina = '$tur->codDisciplina'");
		$dis = mysqli_fetch_object($result);
		?>
	</div>
	    <div class="col-md-12 col-md-offset-0">    	
		   	<div class="panel panel-primary">
				<div class="panel-heading">
						<h3 class="panel-title">Cadastrar Avaliação Turma <?php echo $dis->curso ?></h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="storeAvaliacao.php" >
						<input type="hidden" class="form-control" name="codT" value="<?php echo $turma?>">
						<input type="hidden" class="form-control" name="qtques" value="<?php echo $qtques?>">
						<input type="hidden" class="form-control" name="codA" value="<?php echo $codA['ultimo']?>">
						<?php while($aux < $qtques){?>
						<label class="col-md-3	 control-label">Questão <?php echo $aux+1 ?></label>
						<div class="form-group">
							<div class="col-md-8">
								<select class="form-control" name="<?php echo $aux ?>">
									<?php
									$result = mysqli_query($con, "SELECT * FROM questao where codDisciplina = '$dis->codDisciplina'");
								 	while($turma = mysqli_fetch_object($result)){
								 	?>
										<option value="<?php echo $turma->codQuestao?>"><?php echo $turma->enunciado ?></option>  
									<?php  } ?> 
								</select>
							</div>
						</div>
						<?php $aux=$aux+1;}?>
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
<?php }else{
	echo "Quantidade de questões exece o número de questões do banco";}?>
<?php include_once("../footer.php") ?>