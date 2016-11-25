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

<div class="col-md-12 col-md-offset-0">    	
	   	<div class="panel panel-primary">
			<div class="panel-heading">
					<h3 class="panel-title">Desativar Usuario</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal text-center" method="POST" action="?confirma=ok" >
					<div class="form-group">
						<div class="col-dm-4 col-dm-offset-4">
							Deseja realmente desativar sua conta do sistema <?php echo($_SESSION["login"]) ?> ?
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-1 col-md-offset-6">
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
		$cpf = $_SESSION["cpf"];

		$sql = "UPDATE usuario SET status='desativo' WHERE cpf='$cpf'";

		mysqli_query($con, $sql);
				
		header("Location: desativarUsuario.php?success=Usuario desativado com sucesso!");	
	}
 ?>

<?php include_once("../footer.php") ?>