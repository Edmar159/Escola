<?php include_once("../header.php") ?>
<?php include_once("../validar.php") ?>


<div class="text-center">
	<?php 
		if(isset($_GET['success']))
		{
			?> 
				<p class="bg-success" style="color:green"><?php echo $_GET['success'] ?></p>
			<?php
		}
	?>
</div>
<?php
	if(isset($_GET['codT']))
		$codT=$_GET['codT'];
	if(isset($_GET['codA']))
		$codA=$_GET['codA'];
	if(isset($_POST['codT']))
		$codT=$_POST['codT'];
	if(isset($_POST['codA']))
		$codA=$_POST['codA'];
 ?>

<div class="col-md-12 col-md-offset-0">    	
	   	<div class="panel panel-primary">
			<div class="panel-heading">
					<h3 class="panel-title">Cancelar matrícula</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal text-center" method="POST" action="?confirma=ok" >
					<div class="form-group">
						<div class="col-dm-4 col-dm-offset-4">
							Deseja realmente cancelar matrícula em <?php $resu = mysqli_query($con,"SELECT * from turma WHERE codTurma = '$codT'"); $prof = mysqli_fetch_object($resu); $resu = mysqli_query($con, "SELECT * from disciplina WHERE codDisciplina = '$prof->codDisciplina'"); $prof = mysqli_fetch_object($resu); echo $prof->curso;?> do aluno <?php $resu = mysqli_query($con,"SELECT * from aluno WHERE codAluno = '$codA'"); $prof = mysqli_fetch_object($resu); echo $prof->nome; ?> 
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-1 col-md-offset-6">
							<input type="hidden" name="codT" value="<?php echo $codT ?>">
							<input type="hidden" name="codA" value="<?php echo $codA ?>">
							<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Sim</button>
						</div>
						<div class="col-md-1">					    	
					      <a class="btn btn-default" href="../index.php" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Não</a>
					    </div>
					</div>
				</form>
			</div>
		</div>
</div>

<?php
	if(isset($_GET['confirma'])){
		$resu = mysqli_query($con, "SELECT * from matricula WHERE codAluno = '$codA' and codTurma = '$codT'"); 
		$mat = mysqli_fetch_object($resu);
		if($mat->media != NULL){?>
			<script>javascript:window.location="buscaMat.php?error=Avaliações foram realizadas, impossivel cancelar matrícula";</script>;
			<?php
			exit();
		}else{
			
			mysqli_query($con, "DELETE FROM matricula where (codAluno='$codA' and codTurma='$codT')");
			?>
			<script>javascript:window.location="buscaMat.php?success=Matricula cancelada com sucesso!";</script>;
			<?php
			exit();
		}
	
	}
 ?>

<?php include_once("../footer.php") ?>