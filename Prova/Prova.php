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
$cod_aluno = $_SESSION['cod'];
$codA = $_GET['codA']; 
mysqli_query($con, "INSERT into avaliacao_aluno VALUES ('$codA', '$cod_aluno', 0)");
$result = mysqli_query($con, "SELECT * FROM avaliacao where codAvaliacao = '$codA'");
$aval = mysqli_fetch_object($result);
$result = mysqli_query($con, "SELECT codDisciplina, codProfessor FROM turma where codTurma = '$aval->codTurma'");
$turma = mysqli_fetch_object($result);
$result = mysqli_query($con, "SELECT curso FROM disciplina where codDisciplina = '$turma->codDisciplina'");
$disc = mysqli_fetch_object($result);
$result = mysqli_query($con, "SELECT nome FROM professor where codProfessor = '$turma->codProfessor'");
$prof = mysqli_fetch_object($result);

 ?>

<div class="panel panel-primary">
	<div class="panel-heading">Avaliação de <?php echo $disc->curso; ?></div>
	<table class="table table-striped">
		<tr>
			<td class="col-md-3"><b>Disciplina</b></td>
			<td class="col-md-3"><b>Professor</b></td>
			<td class="col-md-3"></td>
			<td class="col-md-3"></td>
		</tr>
		<tr>
			<td><b> <?php echo $disc->curso ?> </b></td>
			<td><b> <?php echo $prof->nome ?> </b></td>		
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?php
		$aux = 0;
		$coq = 1000;

		$result = mysqli_query($con, "SELECT * from prova where codAvaliacao = '$codA'");
		?>
		<form class="form-horizontal" method="POST" action="storeProva.php">
		<input type="hidden" name="codA" value="<?php echo $codA ?>">
		<?php
		while($prova = mysqli_fetch_object($result)){
			$aux ++;
			$coq ++;
		?>
			<tr>
				<td><b>Questão <?php echo $aux ?> </b></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		<?php	
			$resul = mysqli_query($con, "SELECT * from questao where codQuestao = '$prova->codQuestao'");
			$questao = mysqli_fetch_object($resul);
			?>
			<input type="hidden" name="<?php echo $coq ?>" value="<?php echo $prova->codQuestao ?>">
			<tr>
				<td><span class="detalhes"><?php echo $questao->enunciado ?></span> </td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php
			$rand = rand(1,4);
			if($rand == 1){
			?>
				<tr>
					<td><input type="radio" name="<?php echo $aux; ?>" value="respc"><span class="detalhes"><?php echo $questao->respCerta ?></span> </td>
					<td><input type="radio" name="<?php echo $aux; ?>" value="resp2"><span class="detalhes"><?php echo $questao->resp2 ?></span> </td>
					<td><input type="radio" name="<?php echo $aux; ?>" value="resp3"><span class="detalhes"><?php echo $questao->resp3 ?></span> </td>
					<td><input type="radio" name="<?php echo $aux; ?>" value="resp4"><span class="detalhes"><?php echo $questao->resp4 ?></span> </td>
				</tr>
			<?php
			}elseif($rand == 2){
			?>
				<tr>
					<td><input type="radio" name="<?php echo $aux; ?>" value="resp2"><span class="detalhes"><?php echo $questao->resp2 ?></span> </td>
					<td><input type="radio" name="<?php echo $aux; ?>" value="respc"><span class="detalhes"><?php echo $questao->respCerta ?></span> </td>
					<td><input type="radio" name="<?php echo $aux; ?>" value="resp3"><span class="detalhes"><?php echo $questao->resp3 ?></span> </td>
					<td><input type="radio" name="<?php echo $aux; ?>" value="resp4"><span class="detalhes"><?php echo $questao->resp4 ?></span> </td>
				</tr>
			
			<?php
			}elseif($rand == 3){
			?>
				<tr>
					<td><input type="radio" name="<?php echo $aux; ?>" value="resp2"><span class="detalhes"><?php echo $questao->resp2 ?></span> </td>
					<td><input type="radio" name="<?php echo $aux; ?>" value="resp3"><span class="detalhes"><?php echo $questao->resp3 ?></span> </td>
					<td><input type="radio" name="<?php echo $aux; ?>" value="respc"><span class="detalhes"><?php echo $questao->respCerta ?></span> </td>
					<td><input type="radio" name="<?php echo $aux; ?>" value="resp4"><span class="detalhes"><?php echo $questao->resp4 ?></span> </td>
				</tr>
			<?php
			}elseif($rand == 4){
			?>
				<tr>
					<td><input type="radio" name="<?php echo $aux; ?>" value="resp2"><span class="detalhes"><?php echo $questao->resp2 ?></span> </td>
					<td><input type="radio" name="<?php echo $aux; ?>" value="resp3"><span class="detalhes"><?php echo $questao->resp3 ?></span> </td>
					<td><input type="radio" name="<?php echo $aux; ?>" value="resp4"><span class="detalhes"><?php echo $questao->resp4 ?></span> </td>
					<td><input type="radio" name="<?php echo $aux; ?>" value="respc"><span class="detalhes"><?php echo $questao->respCerta ?></span> </td>	
				</tr>
			<?php
			}
		}
		?>
		<tr>
			<td></td><td></td><td></td>
			<td class="col-md-2"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Finalizar</button>
			</td>
		</tr>
	</table>
</div>


<?php include_once("../footer.php") ?>