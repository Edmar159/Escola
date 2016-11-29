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
$codA = $_GET['cod'];

if( $_SESSION["tipo"] == "professor"){
	
	$result = mysqli_query($con, "SELECT * FROM prova WHERE codAvaliacao = '$codA'");
		
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
					$resul = mysqli_query($con, "SELECT codTurma FROM avaliacao where codAvaliacao = '$codA'");
					$avaliacao_1 = mysqli_fetch_object($resul); 
					$resul = mysqli_query($con, "SELECT codDisciplina FROM turma where codTurma = '$avaliacao_1->codTurma'");
					$cod_disciplina = mysqli_fetch_object($resul);
					$resul = mysqli_query($con, "SELECT * FROM disciplina where codDisciplina = '$cod_disciplina->codDisciplina'");
					$disciplina_1 = mysqli_fetch_object($resul);
					$resul = mysqli_query($con, "SELECT * FROM questao where codQuestao ='$usuario->codQuestao'");
					$prova= mysqli_fetch_object($resul);

					?>
			<form class="form-horizontal" method="POST" action="updateAval.php" >
				<input type="hidden" class="form-control" name="qst" value="<?php echo $prova->codQuestao?>">
				<input type="hidden" class="form-control" name="ava" value="<?php echo $codA?>">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Questão <?php echo $aux?></h3>				
					</div>
					<div class="panel-body">
						<div class="row">
						<div class="form-group ">
						    <label class="col-md-2 control-label">Questão</label>
						    <label class="col-md-1 control-label"><?php echo $prova->enunciado ?></label>
							<div class="col-md-8">
								<select class="form-control" name="<?php echo $aux ?>">
								<?php
									$result3 = mysqli_query($con, "SELECT * FROM questao where codDisciplina = '$disciplina_1->codDisciplina'");
							 		while($turm = mysqli_fetch_object($result3)){
							 		?>
										<option value="<?php echo $turm->codQuestao?>"><?php echo $turm->enunciado ?></option>  
									<?php
									} ?>
									</select>
							</div>
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
