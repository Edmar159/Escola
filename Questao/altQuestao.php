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
$codQ = $_GET['cod'];

if( $_SESSION["tipo"] == "professor"){
	
	$result = mysqli_query($con, "SELECT * FROM questao WHERE codQuestao = '$codQ'");
		
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
				while($usuario = mysqli_fetch_object($result))
				{
					$aux++;
					$resul = mysqli_query($con, "SELECT * FROM questao where codQuestao ='$usuario->codQuestao'");
					$prova= mysqli_fetch_object($resul);

					?>
				<form class="form-horizontal" method="POST" action="updateQuestao.php" >
				<input type="hidden" class="form-control" name="qst" value="<?php echo $prova->codQuestao?>">
				<input type="hidden" class="form-control" name="ava" value="<?php echo $codA?>">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Questão <?php echo $aux?></h3>				
					</div>
					<div class="panel-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Enunciado</label>
								<div class="col-md-8">
								<input type="text" class="form-control" name="enunciado" placeholder="<?php echo $prova->enunciado ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Resposta Correta</label>
								<div class="col-md-8">
								<input type="text" class="form-control" name="respc" placeholder="<?php echo $prova->respCerta ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Resposta 2</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="resp2" placeholder="<?php echo $prova->resp2 ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Resposta 3</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="resp3" placeholder="<?php echo $prova->resp3 ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Resposta 4</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="resp4" placeholder="<?php echo $prova->resp4 ?>">
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
