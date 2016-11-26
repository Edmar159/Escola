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
		if(isset($_GET['cod']))
			$codT = $_GET['cod'];
	?>
</div>
<div class="col-md-12 col-md-offset-0">    	
	   	<div class="panel panel-primary">
			<div class="panel-heading">
					<h3 class="panel-title">Excluir turma</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal text-center" method="POST" action="?confirma=ok" >
					<div class="form-group">
						<div class="col-dm-4 col-dm-offset-4">
							Deseja realmente desativar esta turma  ?
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-1 col-md-offset-6">
							<input type="hidden"  class="form-control" name="codT" value="<?php echo $codT ?>" >							
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
		$codT = $_POST["codT"];

		$result =mysqli_query($con, "SELECT * from matricula WHERE codTurma = '$codT'");
		if(mysqli_num_rows($result)>0){
			?>
			<script>javascript:window.location="altTurma.php?error=Turma já possui alunos matriculados! Impossível apagar!&cod=<?php echo $codT ?>";</script>;
			<?php	
		}else{
			mysqli_query($con, "DELETE from turma WHERE codTurma ='$codT'");
			?>
			<script>javascript:window.location="buscaTurma.php?success=Turma deletada com sucesso!";</script>;
		<?php
		}
		}
 ?>

<?php include_once("../footer.php") ?>